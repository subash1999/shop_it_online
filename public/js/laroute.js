(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"test","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"apple\/mustang","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"admin","name":"admin_dashboard","action":"App\Http\Controllers\Admin_panel\DashboardController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/all_users","name":"all_users.index","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/all_users\/create","name":"all_users.create","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@create"},{"host":null,"methods":["POST"],"uri":"admin\/users\/all_users","name":"all_users.store","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/all_users\/{all_user}","name":"all_users.show","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/all_users\/{all_user}\/edit","name":"all_users.edit","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/users\/all_users\/{all_user}","name":"all_users.update","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/users\/all_users\/{all_user}","name":"all_users.destroy","action":"App\Http\Controllers\Admin_panel\Users\AllUserController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/add_admin","name":"add_admin.index","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/add_admin\/create","name":"add_admin.create","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@create"},{"host":null,"methods":["POST"],"uri":"admin\/users\/add_admin","name":"add_admin.store","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/add_admin\/{add_admin}","name":"add_admin.show","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/add_admin\/{add_admin}\/edit","name":"add_admin.edit","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/users\/add_admin\/{add_admin}","name":"add_admin.update","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/users\/add_admin\/{add_admin}","name":"add_admin.destroy","action":"App\Http\Controllers\Admin_panel\Users\AddAdminController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/user_types","name":null,"action":"App\Http\Controllers\Admin_panel\Users\UserTypeController@index"},{"host":null,"methods":["PUT"],"uri":"admin\/users\/user_types\/{id}","name":null,"action":"App\Http\Controllers\Admin_panel\Users\UserTypeController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/user_types\/get_table","name":null,"action":"App\Http\Controllers\Admin_panel\Users\UserTypeController@getUserTypesTable"},{"host":null,"methods":["GET","HEAD"],"uri":"seller\/register","name":null,"action":"App\Http\Controllers\Seller\SellerController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":"home","action":"App\Http\Controllers\HomeController@index"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

