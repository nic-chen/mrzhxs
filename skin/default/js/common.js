function init()
{
 var pics = document.getElementById("pictures").childNodes;
 var length = pics.length;
 ScrollPic.prototype.flag = 0;
 for(var i = 0 ; i < length ; i++)
 {
  // ����FireFox.....
  if(pics[i].tagName == "TD")
  {
   var td = document.createElement("TD");
   td.innerHTML = pics[i].innerHTML;
   document.getElementById("pictures").appendChild(td);
  }
 }
 document.getElementById("pictures").onmouseover = function ()
 {
  ScrollPic.prototype.flag = 1;
 }
 document.getElementById("pictures").onmouseout = function ()
 {
  if(ScrollPic.prototype.flag = 1)
  {
   ScrollPic.prototype.flag = 0;
   ScrollPic();
  }
 }
 ScrollPic();
}

function ScrollPic()
{
 var layer = document.getElementById('MarqueePictues').getElementsByTagName("DIV")[0];
 if(layer.scrollLeft++ == layer.scrollLeft)
 {
  //��ȥ40Ч��ͼƬ����ʱ�����Ӳ��̡�
  layer.scrollLeft = layer.clientWidth/2 - 40;
 }
 if(ScrollPic.prototype.flag == 0)
 {
  setTimeout("ScrollPic()",20);
 }
}