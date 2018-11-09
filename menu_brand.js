 var stop;
 var stopsub; 
 var curmenu;
 var submenu;
 var thousands_start=21+100;
 var menuwidth=200; 
 var menuheight=50;
 var menu = new Menu();
menu.addItem('Abercrombie Fitch','?p=search&CLASSS=Abercrombie Fitch');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Caps','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Caps');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Caps&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Caps&sex=1');
menu.addsubmenuitem('Flip flop','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Flip flop');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Flip flop&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Flip flop&sex=1');
menu.addsubmenuitem('handbags','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=handbags&sex=2');
menu.addsubmenuitem('Hoody','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Hoody');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Hoody&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Hoody&sex=1');
menu.addsubmenuitem('Jacket','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Jacket');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Jacket&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Jacket&sex=1');
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Jeans&sex=1');
menu.addsubmenuitem('Shorts','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Shorts');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Shorts&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Shorts&sex=1');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Tee&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=Tee&sex=1');
menu.addsubmenuitem('工笔','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=工笔');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Abercrombie Fitch&T_CLASS=工笔&sex=1');

menu.addItem('37','?p=search&CLASSS=37');
menu.addsubmenu();
menu.addsubmenuitem('Shorts','?p=search&T_CHILD=37&T_CLASS=Shorts');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=37&T_CLASS=Shorts&sex=1');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=37&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=37&T_CLASS=Sunglasses&sex=2');

menu.addItem('True religion','?p=search&CLASSS=True religion');
menu.addsubmenu();
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=True religion&T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=True religion&T_CLASS=Jeans&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=True religion&T_CLASS=Jeans&sex=1');

menu.addItem('Prada','?p=search&CLASSS=Prada');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Prada&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Prada&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Prada&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Prada&T_CLASS=Handbags&sex=2');

menu.addItem('Ed hardy','?p=search&CLASSS=Ed hardy');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Ed hardy&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Caps','?p=search&T_CHILD=Ed hardy&T_CLASS=Caps');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Caps&sex=1');
menu.addsubmenuitem('flip flop','?p=search&T_CHILD=Ed hardy&T_CLASS=flip flop');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=flip flop&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=flip flop&sex=1');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Ed hardy&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('Jacket','?p=search&T_CHILD=Ed hardy&T_CLASS=Jacket');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Jacket&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Jacket&sex=1');
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=Ed hardy&T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Jeans&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Jeans&sex=1');
menu.addsubmenuitem('Kids','?p=search&T_CHILD=Ed hardy&T_CLASS=Kids');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Kids&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Kids&sex=1');
menu.addsubmenuitem('Shorts','?p=search&T_CHILD=Ed hardy&T_CLASS=Shorts');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Shorts&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Shorts&sex=1');
menu.addsubmenuitem('sleepwear','?p=search&T_CHILD=Ed hardy&T_CLASS=sleepwear');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=sleepwear&sex=1');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Ed hardy&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Tee&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=Tee&sex=1');
menu.addsubmenuitem('Tracksuit','?p=search&T_CHILD=Ed hardy&T_CLASS=Tracksuit');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=Tracksuit&sex=2');
menu.addsubmenuitem('underwear','?p=search&T_CHILD=Ed hardy&T_CLASS=underwear');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ed hardy&T_CLASS=underwear&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ed hardy&T_CLASS=underwear&sex=1');

menu.addItem('Juicy couture','?p=search&CLASSS=Juicy couture');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Juicy couture&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Caps','?p=search&T_CHILD=Juicy couture&T_CLASS=Caps');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Caps&sex=2');
menu.addsubmenuitem('Dress','?p=search&T_CHILD=Juicy couture&T_CLASS=Dress');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Dress&sex=2');
menu.addsubmenuitem('Flip flop','?p=search&T_CHILD=Juicy couture&T_CLASS=Flip flop');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Flip flop&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Juicy couture&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('Jacket','?p=search&T_CHILD=Juicy couture&T_CLASS=Jacket');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Jacket&sex=2');
menu.addsubmenuitem('Jewelry','?p=search&T_CHILD=Juicy couture&T_CLASS=Jewelry');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Jewelry&sex=2');
menu.addsubmenuitem('Kids','?p=search&T_CHILD=Juicy couture&T_CLASS=Kids');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Kids&sex=2');
menu.addsubmenuitem('Shoes','?p=search&T_CHILD=Juicy couture&T_CLASS=Shoes');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Shoes&sex=2');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Juicy couture&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Tee&sex=2');
menu.addsubmenuitem('Tracksuit','?p=search&T_CHILD=Juicy couture&T_CLASS=Tracksuit');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Juicy couture&T_CLASS=Tracksuit&sex=2');

menu.addItem('39','?p=search&CLASSS=39');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=39&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=39&T_CLASS=Handbags&sex=2');

menu.addItem('Gucci','?p=search&CLASSS=Gucci');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Gucci&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Gucci&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Gucci&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Gucci&T_CLASS=Sunglasses&sex=0');
menu.addsubmenuitem('Wallets','?p=search&T_CHILD=Gucci&T_CLASS=Wallets');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Gucci&T_CLASS=Wallets&sex=0');

menu.addItem('Hermes','?p=search&CLASSS=Hermes');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Hermes&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Hermes&T_CLASS=Handbags&sex=2');

menu.addItem('Rock republic','?p=search&CLASSS=Rock republic');
menu.addsubmenu();
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=Rock republic&T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Rock republic&T_CLASS=Jeans&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Rock republic&T_CLASS=Jeans&sex=1');

menu.addItem('Coach','?p=search&CLASSS=Coach');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Coach&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Coach&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Flip flop','?p=search&T_CHILD=Coach&T_CLASS=Flip flop');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Coach&T_CLASS=Flip flop&sex=2');

menu.addItem('Balenciaga','?p=search&CLASSS=Balenciaga');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Balenciaga&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Balenciaga&T_CLASS=Handbags&sex=2');

menu.addItem('Lacoste','?p=search&CLASSS=Lacoste');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Lacoste&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Lacoste&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Lacoste&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Lacoste&T_CLASS=Tee&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Lacoste&T_CLASS=Tee&sex=1');

menu.addItem('Christian dior','?p=search&CLASSS=Christian dior');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Christian dior&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Christian dior&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Christian dior&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Christian dior&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Christian dior&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Christian dior&T_CLASS=Sunglasses&sex=0');

menu.addItem('Chanel','?p=search&CLASSS=Chanel');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Chanel&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chanel&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Chanel&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chanel&T_CLASS=Handbags&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Chanel&T_CLASS=Handbags&sex=1');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Chanel&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chanel&T_CLASS=Sunglasses&sex=2');
menu.addsubmenuitem('Wallets','?p=search&T_CHILD=Chanel&T_CLASS=Wallets');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chanel&T_CLASS=Wallets&sex=2');

menu.addItem('Louis vuitton','?p=search&CLASSS=Louis vuitton');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Louis vuitton&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Louis vuitton&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Louis vuitton&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Louis vuitton&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('wallets','?p=search&T_CHILD=Louis vuitton&T_CLASS=wallets');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Louis vuitton&T_CLASS=wallets&sex=0');

menu.addItem('Ralph laure(national flag)','?p=search&CLASSS=Ralph laure(national flag)');
menu.addsubmenu();
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Ralph laure(national flag)&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ralph laure(national flag)&T_CLASS=Tee&sex=1');

menu.addItem('Fendi','?p=search&CLASSS=Fendi');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Fendi&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Fendi&T_CLASS=Handbags&sex=2');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Fendi&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Fendi&T_CLASS=Sunglasses&sex=0');

menu.addItem('Miu miu','?p=search&CLASSS=Miu miu');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Miu miu&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Miu miu&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Miu miu&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Miu miu&T_CLASS=Handbags&sex=2');

menu.addItem('UGG','?p=search&CLASSS=UGG');
menu.addsubmenu();
menu.addsubmenuitem('Boot','?p=search&T_CHILD=UGG&T_CLASS=Boot');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=UGG&T_CLASS=Boot&sex=2');

menu.addItem('DG','?p=search&CLASSS=DG');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=DG&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=DG&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=DG&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=DG&T_CLASS=Sunglasses&sex=0');

menu.addItem('Police','?p=search&CLASSS=Police');
menu.addsubmenu();
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Police&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Police&T_CLASS=Sunglasses&sex=0');

menu.addItem('Versace','?p=search&CLASSS=Versace');
menu.addsubmenu();
menu.addsubmenuitem('Dress shirt','?p=search&T_CHILD=Versace&T_CLASS=Dress shirt');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Versace&T_CLASS=Dress shirt&sex=1');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Versace&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Versace&T_CLASS=Sunglasses&sex=0');

menu.addItem('Ferragamo','?p=search&CLASSS=Ferragamo');
menu.addsubmenu();
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Ferragamo&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Ferragamo&T_CLASS=Sunglasses&sex=0');

menu.addItem('Oakley','?p=search&CLASSS=Oakley');
menu.addsubmenu();
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Oakley&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Oakley&T_CLASS=Sunglasses&sex=0');

menu.addItem('Ralph lauren','?p=search&CLASSS=Ralph lauren');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Ralph lauren&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Ralph lauren&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Dress shirt','?p=search&T_CHILD=Ralph lauren&T_CLASS=Dress shirt');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ralph lauren&T_CLASS=Dress shirt&sex=1');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Ralph lauren&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Ralph lauren&T_CLASS=Tee&sex=1');

menu.addItem('Emporio Armani','?p=search&CLASSS=Emporio Armani');
menu.addsubmenu();
menu.addsubmenuitem('Dress shirt','?p=search&T_CHILD=Emporio Armani&T_CLASS=Dress shirt');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Emporio Armani&T_CLASS=Dress shirt&sex=1');
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Emporio Armani&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Emporio Armani&T_CLASS=Sunglasses&sex=0');

menu.addItem('Chloe','?p=search&CLASSS=Chloe');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Chloe&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chloe&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Chloe&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Chloe&T_CLASS=Handbags&sex=2');

menu.addItem('Jimmy choo','?p=search&CLASSS=Jimmy choo');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Jimmy choo&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Jimmy choo&T_CLASS=Handbags&sex=2');

menu.addItem('Paul smith','?p=search&CLASSS=Paul smith');
menu.addsubmenu();
menu.addsubmenuitem('Dress shirt','?p=search&T_CHILD=Paul smith&T_CLASS=Dress shirt');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Paul smith&T_CLASS=Dress shirt&sex=1');

menu.addItem('Ray Ban','?p=search&CLASSS=Ray Ban');
menu.addsubmenu();
menu.addsubmenuitem('Sunglasses','?p=search&T_CHILD=Ray Ban&T_CLASS=Sunglasses');
menu.addlevel2menu();
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Ray Ban&T_CLASS=Sunglasses&sex=0');

menu.addItem('Seven','?p=search&CLASSS=Seven');
menu.addsubmenu();
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=Seven&T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Seven&T_CLASS=Jeans&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Seven&T_CLASS=Jeans&sex=1');

menu.addItem('Burberry','?p=search&CLASSS=Burberry');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Burberry&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Burberry&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Burberry&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Burberry&T_CLASS=Tee&sex=1');

menu.addItem('Billabong','?p=search&CLASSS=Billabong');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Billabong&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Billabong&T_CLASS=Bikini&sex=2');
menu.addsubmenuitem('Flip flop','?p=search&T_CHILD=Billabong&T_CLASS=Flip flop');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Billabong&T_CLASS=Flip flop&sex=2');

menu.addItem('AFFLICTION ','?p=search&CLASSS=AFFLICTION ');
menu.addsubmenu();
menu.addsubmenuitem('Jeans','?p=search&T_CHILD=AFFLICTION &T_CLASS=Jeans');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=AFFLICTION &T_CLASS=Jeans&sex=1');
menu.addsubmenuitem('Tee','?p=search&T_CHILD=AFFLICTION &T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=AFFLICTION &T_CLASS=Tee&sex=1');

menu.addItem('Fred perry','?p=search&CLASSS=Fred perry');
menu.addsubmenu();
menu.addsubmenuitem('Tee','?p=search&T_CHILD=Fred perry&T_CLASS=Tee');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Fred perry&T_CLASS=Tee&sex=1');

menu.addItem('Parah','?p=search&CLASSS=Parah');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Parah&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Parah&T_CLASS=Bikini&sex=2');

menu.addItem('Roxy','?p=search&CLASSS=Roxy');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Roxy&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Roxy&T_CLASS=Bikini&sex=2');

menu.addItem('Other','?p=search&CLASSS=Other');
menu.addsubmenu();
menu.addsubmenuitem('Bikini','?p=search&T_CHILD=Other&T_CLASS=Bikini');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Other&T_CLASS=Bikini&sex=2');

menu.addItem('Anya hindmarch','?p=search&CLASSS=Anya hindmarch');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=Anya hindmarch&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Anya hindmarch&T_CLASS=Handbags&sex=2');
menu.addlevel2menuitem('Unsex style','?p=search&T_CHILD=Anya hindmarch&T_CLASS=Handbags&sex=0');

menu.addItem('BAPE','?p=search&CLASSS=BAPE');
menu.addsubmenu();
menu.addsubmenuitem('Shorts','?p=search&T_CHILD=BAPE&T_CLASS=Shorts');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=BAPE&T_CLASS=Shorts&sex=1');

menu.addItem('13.5','?p=search&CLASSS=13.5');
menu.addsubmenu();
menu.addsubmenuitem('Caps','?p=search&T_CHILD=13.5&T_CLASS=Caps');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=13.5&T_CLASS=Caps&sex=2');

menu.addItem('37.5','?p=search&CLASSS=37.5');
menu.addsubmenu();
menu.addsubmenuitem('Shorts','?p=search&T_CHILD=37.5&T_CLASS=Shorts');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=37.5&T_CLASS=Shorts&sex=1');

menu.addItem('Canada goose','?p=search&CLASSS=Canada goose');
menu.addsubmenu();
menu.addsubmenuitem('jacket','?p=search&T_CHILD=Canada goose&T_CLASS=jacket');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=Canada goose&T_CLASS=jacket&sex=2');
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Canada goose&T_CLASS=jacket&sex=1');

menu.addItem('33','?p=search&CLASSS=33');
menu.addsubmenu();
menu.addsubmenuitem('Kids','?p=search&T_CHILD=33&T_CLASS=Kids');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=33&T_CLASS=Kids&sex=2');

menu.addItem('Peak','?p=search&CLASSS=Peak');
menu.addsubmenu();
menu.addsubmenuitem('jacket','?p=search&T_CHILD=Peak&T_CLASS=jacket');
menu.addlevel2menu();
menu.addlevel2menuitem('Men style','?p=search&T_CHILD=Peak&T_CLASS=jacket&sex=1');

menu.addItem('99','?p=search&CLASSS=99');
menu.addsubmenu();
menu.addsubmenuitem('Handbags','?p=search&T_CHILD=99&T_CLASS=Handbags');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=99&T_CLASS=Handbags&sex=2');

menu.addItem('28','?p=search&CLASSS=28');
menu.addsubmenu();
menu.addsubmenuitem('Kids','?p=search&T_CHILD=28&T_CLASS=Kids');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=28&T_CLASS=Kids&sex=2');

menu.addItem('19.5','?p=search&CLASSS=19.5');
menu.addsubmenu();
menu.addsubmenuitem('Kids','?p=search&T_CHILD=19.5&T_CLASS=Kids');
menu.addlevel2menu();
menu.addlevel2menuitem('Women style','?p=search&T_CHILD=19.5&T_CLASS=Kids&sex=2');

menu.showMenu();