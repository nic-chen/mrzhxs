var stop;
var stopsub;
var curmenu="";
var submenu="";
var menuwidth=150;
var menuheight=30;
var menu = new Menu();

menu.addItem('Oder','#');
menu.addsubmenu();
menu.addsubmenuitem('Waiting for payment','search.php?step=1&action=step','left');
menu.addsubmenuitem('Prepare item, got payment','search.php?step=2&action=step','left');
menu.addsubmenuitem('Sent out add number','search.php?step=3&action=step','left');
menu.addsubmenuitem('Wait for customer confirm','search.php?step=4&action=step','left');
menu.addsubmenuitem('ALL done!','search.php?step=5&action=step','left');

menu.showMenu();
