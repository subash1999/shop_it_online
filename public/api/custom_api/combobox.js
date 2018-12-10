$('select.combobox').click(combo(this));
$('select.combobox').mouseout(comboInit(this,'theinput'));
function comboInit(thelist) {
	theinput = document.getElementById(theinput);
	var idx = thelist.selectedIndex;
	var content = thelist.options[idx].innerHTML;
	if(theinput.value==""){
		theinput.value = content;
	}
}
function combo(thelist,theinput){
	theinput = document.getElementById(theinput);
	var idx = thelist.selectedIndex;
	var content = thislist.options[idx].innerHTML;
	theinput.value = content;
}