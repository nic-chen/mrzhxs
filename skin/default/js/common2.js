//open window
function Winopen(Url)
{
	window.open(Url,"facility","left=0,top=0,width=700,height=600,toolbar=1,status=1,scrollbars=1");
}
// Sidemenu show
function show(no){
var Obj=eval("menusub" + no);

if(Obj.style.display=='none')
 {
   Obj.style.display='';
 }
else
 {
   Obj.style.display='none';
 }
}
//Tree show
function initMenu(obj,list) {
var cobj=document.getElementById(list);
if(cobj != null){
cobj.style.display=(cobj.style.display=="none") ? "" : "none";
}
}