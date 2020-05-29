
/*  Build tables from DB data (via AJAX jquery)  */

//Retrieve data from DB
$.get("script/emprunt_liste.php?id=1", function(reponse,status) { 
   // alert (reponse);
    var	source = JSON.parse(reponse);	
    
    //Create arrays to hold data for current loans and past loans
    var tableau1 = new Array();
    var tableau2 = new Array();
    
    //Create liste of table headings
    tableau1.push(["titre","ISBN","Emprunt&eacute;","Retour prévu"]);	
    tableau2.push(["titre","ISBN","Emprunt&eacute;","Retourné"]);	

    //Add list of cell contents to corresponding array
    for(let i=0;i<source.length;i++) {
        if (source[i].en_cours_Emprunt == 1) {
            tableau1.push([source[i].titre_Ouvrage,source[i].id_officielle_Ouvrage,source[i].date_retrait_Emprunt,source[i].date_retour_prevu_Emprunt]);
        }
        else {
            tableau2.push([source[i].titre_Ouvrage,source[i].id_officielle_Ouvrage,source[i].date_retrait_Emprunt,source[i].date_retour_Emprunt]);
        }
    }
                                            
    /* Start html table for CURRENT loans */
    var table = $('<table id="t_encours" class="display table table-striped table-bordered" style="width:100%" />');
    var nbrColonne = tableau1[0].length;
    var tete = $("<thead />");				
    var ligne = $(table[0].insertRow(-1));			//insert heading row   
        for (let i = 0; i < nbrColonne; i++) {		//fill heading cells
                var headerCell = $('<th />');
                headerCell.html(tableau1[0][i]);
                ligne.append(headerCell);
            } 
    tete.html(ligne); 

    /* table body */	
    for (let i = 1; i < tableau1.length; i++) {			
        ligne2 = $(table[0].insertRow(-1));			//insert a row for each item 
        for (let j = 0; j < nbrColonne; j++) {		//insert data in cells
            var cell = $("<td />");	
            cell.html(tableau1[i][j]);
            ligne2.append(cell);
        }
    }  
    table.append(tete);	

    //insert table in html page
    var divTable = $("#en_cours");		//html div to insert table into
    divTable.html("");
    divTable.append(table); 

     // Start html table for PAST loans//
     var table = $('<table id="t_historique" class="display table table-striped table-bordered" style="width:100%" />');
     var nbrColonne = tableau2[0].length;
     var tete = $("<thead />");				
     var ligne = $(table[0].insertRow(-1));			//insert heading row   
         for (let i = 0; i < nbrColonne; i++) {		//fill heading cells
                 var headerCell = $('<th />');
                 headerCell.html(tableau2[0][i]);
                 ligne.append(headerCell);
             } 
     tete.html(ligne); 
 
     // table body //	
    for (let i = 1; i < tableau2.length; i++) {			
        ligne2 = $(table[0].insertRow(-1));			//insert a row for each item 
        for (let j = 0; j < nbrColonne; j++) {		//insert data in cells
            var cell = $("<td />");	
            cell.html(tableau2[i][j]);
            ligne2.append(cell);
        }
     }  
     table.append(tete);	
 
     //insert table in html page
     var divTable = $("#historique");		//html div to insert table into
     divTable.html("");
     divTable.append(table); 
    

     /*  DataTable styling    */
    $('#t_encours').DataTable( {
        "paging":   false,
        "searching": false,
        "info":     false
    });
    $('#t_historique').DataTable( {
        "info": false
    });
        
});