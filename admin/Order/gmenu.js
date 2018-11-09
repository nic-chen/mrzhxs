function findposx(s,level)
{
	if (level == 0)
	{
		var cnt = 2;
		var idx = 0;
	}
	else
	{
		var cnt = 2;

		var idx = 0;
	}
	var curLeft = 0;
	if (s.offsetParent)
	{
		while (s.offsetParent && (idx < cnt))
		{
			curLeft += s.offsetLeft;
			s = s.offsetParent;
			idx+=1;
		}
	}
	else if (s.x) { curLeft += s.x; }
	return curLeft;
}



function findposy(s,level)
{
	if (level == 0)
	{
		var cnt = 2;
		var idx = 0;
	}
	else
	{
		var cnt = 2;
		var idx = 0;
	}
	var curTop = 0;
	if (s.offsetParent)
	{
		while (s.offsetParent && (idx < cnt))
		{
			curTop += s.offsetTop;
			s = s.offsetParent;
			idx +=1;
		}
	}
	else if (s.x) { curTop += s.x; }
	return curTop;
}



function setmenus(s)

{
	curmenu = s;
}



function setsubmenus(s)
{
	submenu = s;
	var x = submenu.substring(0,3)
	x = x + '0';
	curmenu = x;
}



function expand(s)
{
	curmenu = s.id;
	var x = s.id;
	var count = parseInt(x,10);
	count += 100;
	if (count < 1000)
	{
		x = '0' + count;
	}
	else
	{
		x = count;
	}
	var td = document.getElementById(x);
	var posx = findposx(s,0);
	var posy = findposy(s,0) + menuheight;
	if (td != null)
	{ 
		td.style.left = "" + posx + "px";
		td.style.top = "" + posy + "px";
		td.style.display = 'block';
	}

}



function checkpos(s)
{
	stop = window.setTimeout("collapse('"+s+"')",005);
}



function checksubpos(s)
{
	stopsub = window.setTimeout("collapsesub('"+s+"')",005);
}



function collapsesub(s)
{
	if (s.substring(0,3) != submenu.substring(0,3))
	{
		var td = document.getElementById(s);
		if (td != null)
		{ 
		var x = s;
			var count = parseInt(x,10);
			count += 1;
			if (count < 1000)
			{
				x = '0' + count;
			}
			else
			{
				x = count;
			}
			td = document.getElementById(x);
			if (td != null)
			{
				td.style.display = 'none';
			}
		}
	}



	if (s.substring(0,1) != curmenu.substring(0,1) || curmenu == '0') 
	{
		var td = document.getElementById(s);
		if (td != null)
		{ 
			var x = s;
			var y = x.substring(0,2);
			y = y + '00';
			td = document.getElementById(y);
			if (td != null)
			{
				td.style.display = 'none';
			}
		}
	}
}



function collapse(s)

{
	if (s.substring(0,1) != curmenu.substring(0,1))
	{
		var td = document.getElementById(s);
		if (td != null)
		{ 
			var x = s;
			var count = parseInt(x,10);
			count += 100;
			if (count < 1000)
			{
				x = '0' + count;
			}
			else
			{
				x = count;
			}
			td = document.getElementById(x);
			if (td != null)
				{ td.style.display = 'none';}
		}
	}
}



function expandsub(s,direction)

{
	submenu = s.id;
	var x = s.id;
	var count = parseInt(x,10);
	count += 1;
	if (count < 1000)	{
		x = '0' + count;
	}
	else
	{
		x = count;
	}

	var td = document.getElementById(x);
	if (direction == 'right')
	{	
		var posx = findposx(s,1) + menuwidth;
	}
	else
	{
		var posx = findposx(s,1) - menuwidth;
	}

	var posy = findposy(s,1);
	if (td != null)
	{ 
		td.style.left = "" + posx + "px";
		td.style.top = "" + posy + "px";
		td.style.display = 'block';
	}
}



function Menu()

{
	this.addItem = addItem;
	this.addsubmenu = addsubmenu;
	this.addsubmenuitem = addsubmenuitem;
	this.addlevel2menu = addlevel2menu;
	this.addlevel2menuitem = addlevel2menuitem;
	this.showMenu = showMenu;

	thousands = 0;
	hundreds = 0;
	tens = 0;
	digits = 0;
	htmlstr="";
	htmlstr += "<!--GMENU Version 2.1-->";
	htmlstr += "<table cellpadding=0 cellspacing=0 border=0 class='gmenu'><tr><!--GMENUITEMS--></tr></table><!--SUBMENU-->";
	htmlstr += "<!--End of Gmenu-->";
}



function addItem(menuname,lnk)
{
	var id = "";
	hundreds = 0;
	tens = 0;
	digits = 0;
	id = "" + thousands + hundreds + tens + digits + "";
	menustr = "";
	menustr+= "<td class=\"gmenu\" width=\""+menuwidth+"\" id=\""+id+"\" onmouseover=\"expand(this)\" onmouseout=\"setmenus('');checkpos('"+id+"')\"><a href='"+lnk+"' class=\"gmenu\">"+menuname+"</a></td>";
	menustr+="<!--GMENUITEMS-->";
	htmlstr = htmlstr.replace("<!--GMENUITEMS-->",menustr);
	thousands+=1;
}



function addsubmenu()

{
	var id = "";
	hundreds = hundreds + 1;

	currentthousands = thousands - 1;

	htmlstr = htmlstr.replace("<!--SUBMENUITEMS-->",'');	

	id = "" + currentthousands + hundreds + tens + digits + "";

	pid = "" + currentthousands + "000";

	menustr = "";

	menustr+="<div id=\""+id+"\" class=\"submenu\" style=\"position:absolute;left:0;top:0;display:none;z-index:10\" onmouseover=\"setmenus('"+id+"')\" onmouseout=\"setmenus('');checkpos('"+pid+"')\"><!--SUBMENUITEMS--></div>";

	menustr+="<!--SUBMENU-->";

	htmlstr = htmlstr.replace("<!--SUBMENU-->",menustr);	

}



function addsubmenuitem(name,lnk,direction)

{

	var id = "";

	tens = tens + 1;

	digits = 0;

	currentthousands = thousands - 1;

	id = "" + currentthousands + hundreds + tens + digits + "";

	menustr = "";
	if (direction == 'left')
	{

		menustr+="<a id=\""+id+"\" href=\""+lnk+"\" onmouseover=\"setsubmenus('"+id+"');expandsub(this,'left')\" onmouseout=\"setsubmenus('');checksubpos('"+id+"')\" class=\"gmenuSub\">"+name+"</a>";
	}
	else
	{
		menustr+="<a id=\""+id+"\" href=\""+lnk+"\" onmouseover=\"setsubmenus('"+id+"');expandsub(this,'right')\" onmouseout=\"setsubmenus('');checksubpos('"+id+"')\" class=\"gmenuSub\">"+name+"</a>";

	}

	menustr+="<!--SUBMENUITEMS-->";

	htmlstr = htmlstr.replace("<!--SUBMENUITEMS-->",menustr);



}



function addlevel2menu()

{

	var id = "";

	currentthousands = thousands - 1;

	digits+=1;

	htmlstr = htmlstr.replace("<!--LEVEL2ITEMS-->",'');	

	id = "" + currentthousands + hundreds + tens + digits + "";

	pid = "" + currentthousands + hundreds + tens + "0";

	menustr = "";

	menustr+="<div id=\""+id+"\" class=\"level2menu\" style=\"position:absolute;display:none;z-index:10\" onmouseover=\"setsubmenus('"+id+"')\" onmouseout=\"setsubmenus('');checksubpos('"+pid+"')\"><!--LEVEL2ITEMS--></div>";

	menustr+="<!--SUBMENU-->";

	htmlstr = htmlstr.replace("<!--SUBMENU-->",menustr);	

	



}



function addlevel2menuitem(name,lnk)

{



	menustr = "";

	menustr+="<a href='"+lnk+"'>"+name+"</a>";

	menustr+="<!--LEVEL2ITEMS-->";



	htmlstr = htmlstr.replace("<!--LEVEL2ITEMS-->",menustr);





}





function showMenu()

{
//	alert(htmlstr);
	document.writeln(htmlstr);
}

