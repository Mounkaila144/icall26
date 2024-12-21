<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>

 body {
    /*font-family: arial;*/
    margin: 0px;
    font-family: times new romans;
  }
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding:  8px;
 
}

  .pageSuivante {
    page-break-after: always;
    position: relative;
  }
 .cadreDevis {

      position:relative;
      height:2330px !important;
     
      
    }
.tableProduit{
 
    margin-left:15px;
    margin-right:15px;
    width:94%;
    align: center;
    margin-left:auto;
    margin-right:auto;
   /* background-color: lightblue;*/
    
  
}
.theadProduit{
 background: #cae3ad;font-size:23px;text-align: center;font-weight:bold;
}
 .tableProduit th,
    .tableProduit td {
      border:solid 1px black;
      text-align: center;

    }
    .tableProduit {
      border-collapse:collapse;
    }
 
.cpiEcritureDixHuit {
      font-size:18;
    }
  .imgFooter{
      position: absolute;
      bottom: 40px;
    }
  .numberOfPage {
      text-align:right;
      font-size:24px;

    }
.footerAllPage {
   /*   position:absolute;
      bottom:50px;
      height: 200px;
      padding-left:15px;
      width:1550px;*/
       position:absolute;
      bottom:15px;

      padding-left:15px;
      width:1550px;

    }
     .PacTableInfoDevis {
      left:897px;
      position:relative;
      bottom:35px;
    }
    .tableDevis th,
    .tableDevis td {
      border: solid 1px black;
      font-size: 30px;
      width:200px;

    }
    .tableDevis {
      border-spacing: 0px;
      text-align: center;
    }

    .infoClient {
      position:relative;
      left: 897px;
      top:50px;

      padding-left: 10px;
      font-size:27px;
      width:627px;
    }
     .cpiEcritureVingtQuatre {
      font-size:24px;
    }
      .infoEntrepriseTop {
      position:relative;
      left: 50px;
      bottom:83px;
      font-size:24px;
    }
    .infoEntrepriseTop td {
      height:35px;
    }
      .infoEntrepriseGras {
      font-weight:bold;
    }
     .renseignementEntreprise {
      margin-top:10px;
    }
  .header{
    position:relative;
    margin-top: 30px;
    height: 550px;
    }
    .logo {
      position:absolute;
       margin-left: 50px;
      margin-top: 40px;
 
      width:160px;
      height:160px;
      left:50px;
       top:0px
    }
    .container{
        margin-top: -40px;
        position:relative;
        height:1525px !important;
      background-color:lightblue;
       
      
    }
    .greenDiv
    {
        width: 100px;
        height: 95px;
        background: #b4d863;
        margin-left:1550px;
        margin-top:3px;
        border-radius: 0% 0% 0% 100%;
    }

</style>
</head>
<body>

 
 {assign var="nbrPage" value="0"}
    {assign var="totalPage" value="0"}
    {foreach $products as $product}
      {$totalPage=$totalPage+1}
    {/foreach}
           <div class="pageSuivante cadreDevis ProductsAndItems">
                
         <div class="greenDiv"></div>
             
     <div class="header">
          {if $company.picture}  <img class="logo" src="{$company.picture.url}" />{/if}
      <div style="">
         <table class="PacTableInfoDevis">
          <tr>
            <td>
              <div>
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">DEVIS</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tableDevis">{$quotation.reference}</td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td>
              <div>
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">DATE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="">{$contract.quoted_at.ddmmyyyy}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td>
              <div style="">
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">CLIENT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="">{$customer.id}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </table>
      </div>


      <div class="infoClient" style="">
        <div class="" style="font-size:29px;font-weight:bold">CLIENT</div>
        <div class="" >{$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
        <div class="cpiEcritureVingtQuatre" style="margin-top: 7px;">
          <span class="" style="font-weight: bold;color: #b0e539;">DELAI DE LIVRAISON :</span> 3 mois
        </div>

        <div class="cpiEcritureVingtQuatre" style=""><span style="color: #b0e539;font-weight: bold;">{$i} Offre valable j"usqu"au :</span>{if $contract.quoted_at} {$contract.quoted_at_90.ddmmyyyy} {else} {$quotation.dated_at_90.ddmmyyyy} {/if}
        </div>
      </div>
      <div class="infoEntrepriseTop infoEntrepriseGras" style="marg">

        <div style="">{$company.name}</div>
        <div style="">{$company.address1}</div>
        <div style="">{$company.postcode}, {$company.city}</div>
      </div>
      <div class="infoEntrepriseTop renseignementEntreprise" style="">
        TELEPHONE : {$company.phone}<br>
        SIRET : {$company.siret} <br>
        TVA INTRA : {$company.tva}<br>
        N° RGE : {$company.rge}


      </div>
  </div>
      
    <div class="container" >
           <table id ="table-0" class="tableProduit">
          <thead class="theadProduit" >
            <th style="width:70%;">DETAILS TEST</th>
            <th style="width:5%;">TVA</th>
            <th style="width:5%;">QTE</th>
            <th style="width:8%;">P.U. HT</th>
            <th style="width:8%;">TOTAL HT</th>
          </thead>
            <tbody>
    {foreach $products as $product name=test}
        
          {foreach $product.items as $items}
            
          {if $items.item.input1!=="calcule_maprime_renov" && $items.item.input1!=="calcule_prime_cee"  && $items.item.input1!=="pdf_devis_financeur"&& $items.item.input1!=="pdf_devis_remise"
          && $items.item.input1!=="financial_descent"&& $items.item.input1!=="pdf_devis_action" && $items.item.input1!=="double_page"}
            {if $product@index == 0}
                        {if $items@index == 0}
                               <tr>

                                <td class="" style="vertical-align:top;line-height: 1.235;">
                            
                              <div class="" style="font-size:22px;text-align:left;vertical-align:top;text-transform: uppercase;background: #fcfcfc;padding-left:10px;padding-top:8px;"><span style="">
                                BAR-TH-164 : Rénovation globale d'une maison individuelle <br> de surface habitable (Shab) <span style="color: blue"> {$contract.request.surface_home} </span> ayant un équipement de production de chaleur utilisant du
                                <span style="color: blue"> {$contract.request.energy_id}.</span>    
                                L'audit énergétique a été réalisée le  <span style="color: blue"> {$contract.forms.TH164.DateEtude} </span> par le bureau d'étude <span style="color: blue"> {$contract.forms.TH164.NomEtudeEnergetique}</span>, n° SIRET <span style="color: blue"> {$contract.forms.TH164.SirenEtudeEnergetique}</span>, n° RGE <span style="color: blue"> {$contract.forms.TH164.RgeEtudeEnergetique} </span> étude <span style="color: blue"> {$contract.forms.TH164.NumeroEtude} </span> sous la
                                référence <span style="color: blue">  {$contract.forms.TH164.NumeroEtude}</span>, en utilisant le logiciel  <span style="color: blue"> {$contract.forms.TH164.NomLogiciel}</span>, version <span style="color: blue"> {$contract.forms.TH164.VersionLogiciel}.</span>
                                Le logiciel utilise un moteur de calcul validé par le CSTB, le CEREMA qui prend en compte les <span style="color: blue"> {$contract.forms.TH164.nombreoperation}</span> 3 usages suivants : <span style="color: blue"> {$contract.forms.TH164.DomaineEtudeEnergetique} </span>
                                La formule de calcul est : (Cef initial - Cef projet) X Shab X Coefficient de bonification Coup de Pouce
                                Caractéristiques du bâtiment données par l'étude énergétique : <br>
                                * Cef initial : <span style="color: blue"> {$contract.request.cep} kWh/m².an </span> * Cef projet : <span style="color: blue"> {$contract.request.cep_project} kWh/m².an</span>  (Consommation conventionnelle en Energie Finale avant et après les travaux de rénovations) <br>
                                * Cep initial : <span style="color: blue"> {$contract.request.cef} kWh/m².an </span> * Cep projet : <span style="color: blue"> {$contract.request.cef} kWh/m².an </span> (Consommation conventionnelle en Energie Primaire avant et après les travaux de rénovations)<br>
                                - Gain énérgetique du projet par rapport à la consommation conventionnelle en énergie primaire avant travaux : <span style="color: blue"> {$contract.forms.TH164.GAINENERGETIQUE}%.</span> <br>
                                - Travaux incluant le changement de tous les équipements de production de chaleur (chauffage ou Eau Chaude Sanitaire) au charbon ou au fioul
                                non performants (toutes technologies autre qu'à condensation).<br>
                                - Les émissions de gaz à effet de serre (kgeqCO2/m²) après rénovation sont inférieures ou égales à la valeur initiale de ces émissions avant
                                travaux.<br>
                                - Les équipements de production de chaleur chauffage ou ECS installés utilisent <span style="color: blue"> {$contract.forms.TH164.energierenouvelable} %</span>. d'énergie renouvelable et de récupération (EnR&R).
                                Travaux réalisés

                                  </span></div>


                                </td><td class="" style="vertical-align:top;font-size:22px;"><div style="background:  #f2f2f2;margin-top:12px;"> </div> </td>
                                <td class="" style="vertical-align:top;font-size:22px;"><div style="background:  #f2f2f2;margin-top:12px;"></div> </td>
                                <td class="" style="vertical-align:top;font-size:22px;"><div style="background:  #f2f2f2;margin-top:12px;"> </div> </td>
                                <td class="" style="text-align: center;font-size:22px;vertical-align:top;"><div style="background:  #f2f2f2;margin-top:12px;"></div>
                                </td>
                             
                       

                        {/if}
                        
                       {/if}
            <tr>
               <td class="" style="vertical-align:top;">
              <div class="" style="font-size:22px;text-align:left;vertical-align:top;background: #f2f2f2;text-transform: uppercase;text-align:center;margin-top:12px;"><span style="">référence:</span>{$items.item.input1}</div>
              <div class="" style="font-size:22px;text-align:left;vertical-align:top;text-transform: uppercase;background: #fcfcfc;padding-left:10px;padding-top:10px;"><span style="">désignation: </span>{eval $items.item.description}</div>

            </td><td class="" style="vertical-align:top;font-size:22px;"><div style="background:  #f2f2f2;margin-top:12px;"> {$items.rate_tax}</div> </td>
            <td class="" style="vertical-align:top;font-size:22px;w"><div style="background:  #f2f2f2;margin-top:12px;">{$items.quantity|upper} </div> </td>
            <td class="" style="vertical-align:top;font-size:22px"><div style="background:  #f2f2f2;margin-top:12px;">{$items.sale_price_without_tax|upper} </div> </td>
            <td class="" style="text-align: center;font-size:22px;vertical-align:top;"><div style="background:  #f2f2f2;margin-top:12px;">{$items.total_sale_price_without_tax|upper}</div>
            </td>
          </tr>
          {/if}
          
          {/foreach}
 
     
    {/foreach}
    </tbody>
      </table>
    </div>
 
   <footer class="footerAllPage ProductsFooter">        
              
        <div class="cpiEcritureDixHuit" style="">
          <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
            Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {$company.comments}
             
          </div>
          {if $company.picture.url}
          <div class="imgFooter">


            <img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />
          </div>
          {/if}
        </div>
        {$nbrPage=$nbrPage+1}
            <div class="numberOfPage numberOfPageForProducts" style="margin-top:-40px;"><span class="Pager">Page </span></div>
       </footer>
        <div id="info">---</div>  
  <script>
                //theadProduit
               /*  $(document).ready(function(){ 
                 $("#regTitle").html("Hello World");
                  });*/
                  var nbrTable=0;
                  var table =  document.getElementById("table-"+nbrTable);
                  var total =table.getElementsByTagName('tbody')[0].scrollHeight/2500;
                 document.getElementById("info").innerHTML+=document.getElementsByClassName('container')[0].scrollHeight;
               
                   //for(j = 0; j < Math.ceil(total); j++) {
                  //   document.getElementById("total").innerHTML+=j;
                     var rows = document.querySelectorAll('#table-'+nbrTable+' tbody tr'); 
                     
                     var height_of_rows =0;
                    
                     var cadre_devis = document.createElement('div');
                     cadre_devis.setAttribute('class', 'pageSuivante cadreDevis');

                     var greenDiv = document.createElement('div');//greenDiv
                     greenDiv.setAttribute('class', 'greenDiv');

                     var container = document.createElement('div');
                     container.setAttribute('class', 'container');

                     var thead= document.getElementsByClassName("theadProduit")[0]//theadProduit
                    

                     var mytable = document.createElement('table');
                   
                     mytable.setAttribute('id', 'table-'+nbrTable);//tableProduit
                     mytable.setAttribute('class', 'tableProduit');
                     mytable.createTHead();
                     mytable.createTBody();
                     
                        for(i = 0; i < rows.length; i++) {

                               height_of_rows +=rows[i].scrollHeight ;                           
                               if(document.getElementById("table-"+nbrTable).scrollHeight<=2500)
                               {
                                 rows[i].cells[0].innerHTML+="offsetheight "+height_of_rows+"-test-"+i+"-"+rows[i].scrollHeight;
                                  var tr =rows[i].cloneNode(true);
                                //  rows[i].remove();
                                  mytable.getElementsByTagName('tbody')[0].appendChild(tr);
                                   
                               }
                               else{
                                 document.getElementsByTagName('body')[0].appendChild(cadre_devis);

                                var footer = document.getElementsByClassName("ProductsFooter")[0];                                              
                                var header = document.getElementsByClassName("header")[0];

                                cadre_devis.insertBefore(header.cloneNode(true), cadre_devis.firstChild);
                                cadre_devis.insertBefore(greenDiv.cloneNode(true), cadre_devis.firstChild);
                                mytable.insertBefore(thead.cloneNode(true), mytable.firstChild);
                                container.appendChild(mytable); 
                                var footer1=footer.cloneNode(true);
                                //footer1.getElementsByClassName("numberOfPageForProducts")[0].innerHTML="Page "+(nbrTable+1)+"/{$totalPage+2}";
                                cadre_devis.appendChild(footer1);   
                                cadre_devis.appendChild(container);         
                                nbrTable=nbrTable+1;
                                mytable.setAttribute('id', 'table-'+nbrTable);//tableProduit
                                mytable.setAttribute('class', 'tableProduit');
                                mytable.createTHead();
                                mytable.createTBody();
                                }
                         }
                           var footer = document.getElementsByClassName("ProductsFooter")[0];                                              
                        var header = document.getElementsByClassName("header")[0];

                        cadre_devis.insertBefore(header.cloneNode(true), cadre_devis.firstChild);
                        cadre_devis.insertBefore(greenDiv.cloneNode(true), cadre_devis.firstChild);
                        mytable.insertBefore(thead.cloneNode(true), mytable.firstChild);
                        container.appendChild(mytable); 
                        var footer1=footer.cloneNode(true);
                        //footer1.getElementsByClassName("numberOfPageForProducts")[0].innerHTML="Page "+(nbrTable+1)+"/{$totalPage+2}";
                        cadre_devis.appendChild(footer1);   
                        cadre_devis.appendChild(container);       
                       table.remove();
                    document.getElementById("info").innerHTML+="----"+height_of_rows+"-----";   
                   
                   
                  
                         
                        
                   
                  //}
                    


       </script>
       
      
</div>
<div class="cadreDevis pageSuivante">
      <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

      {if $company.picture}  <img class="logo"style="width:220px;height:130px;position:absolute;left:50px;top:30px" src="{$company.picture.url}" />{/if}
      <div style="">
        <table class="PacTableInfoDevis">
          <tr>
            <td>
              <div>
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">DEVIS</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tableDevis">{$quotation.reference}</td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td>
              <div>
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">DATE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="">{$contract.quoted_at.ddmmyyyy}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
            <td>
              <div style="">
                <table class="tableDevis">
                  <thead>
                    <tr>
                      <th style="">CLIENT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="">{$customer.id}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="infoClient" style="">
        <div class="" style="font-weight: bold;font-size:29px;">CLIENT</div>
        <div class="" > {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
      </div>
      <div class="infoEntrepriseTop infoEntrepriseGras">

        <div style="">{$company.name}</div>
        <div style="">{$company.address1}</div>
        <div style="">{$company.postcode}, {$company.city}</div>
      </div>


      <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:35px;font-size:20px">
<thead>
        <tr>
          <th colspan="7" class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
            INSTALLATION
          </th>
        </tr>
      </thead>
        <tr>

          <th style="background-color:#cae3ad;">Opérations</th>
          <th style="background-color:#cae3ad;">Raison Sociale</th>
          <th style="background-color:#cae3ad;">Addresse</th>
          <th style="background-color:#cae3ad">Siret</th>
          <th style="background-color:#cae3ad;">N° RGE</th>
            <th style="background-color:#cae3ad;">Date de validité du RGE</th>
              <th style="background-color:#cae3ad;">Décénnale</th>
            </tr>





            {foreach $works as $work }
            {if $work.layer}
            {if $work.polluter.type == "ITE"}

  <tr class="firstTd" style="padding-left:10px;padding-top:5px;">
            <td> ITE </td>
            <td> <span>   <span style="color:blue;">{$work.layer.name} </span></td>
            <td>  <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

            {/if}
</tr>
            {if $work.polluter.type == "VMC1"}
<tr>
            <td>VMC 1: </td>
          <td>   <span style="color:blue;">{$work.layer.name} </span></td>
            <td>  <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

            {/if}
</tr>
            {if $work.polluter.type == "VMC2"}
<tr>
            <td> VMC2 : </td>
          <td>     <span style="color:blue;">{$work.layer.name} </span></td>
            <td>  <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

            {/if}
</tr>
            {if $work.polluter.type == "TYPE1"}
<tr>
            <td>TYPE1:  </td>
          <td>     <span style="color:blue;">{$work.layer.name} </span></td>
            <td>  <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

            {/if}
</tr>
            {if $work.polluter.type == "BOILER"}
<tr>
            <td>CHAUDIERE :  </td>
            <td>  <span style="color:blue;">{$work.layer.name} </span></td>
            <td>  <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td> <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

            {/if}
</tr>
            {if $work.polluter.type == "PAC"}
<tr>
            <td>PAC: </td>
            <td> <span style="color:blue;">{$work.layer.name} </span></td>
          <td>    <span style="color:blue;">{$work.layer.address}</span></td>
            <td>  <span style="color:blue;">{$work.layer.siret}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge}</span></td>
            <td>  <span style="color:blue;">{$work.layer.rge_end_at.ddmmyyyy}</span></td>
            <td>   <span style="color:blue;">{$work.layer.address2}</span></td>

</tr>
            {/if}


            {/if}
            {/foreach}


      </table>


      <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:110px;">
        <tr>
          <th class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
            LIEU D’INSTALLATION
          </th>
        </tr>
        <tr>

          <td class="" style="padding-left:10px;">
            <div class="" style="font-weight: bold;text-align:left;font-size:24px;padding-top:5px;">
              <span style="">- ADRESSE : <span style="color:blue;">{$customer.address.address1|upper}</span>
              <span style="">- CODE POSTAL :<span style="color:blue;">{$customer.address.postcode|upper}</span>
              <span style="">- VILLE : <span style="color:blue;">{$customer.address.city|upper}</span>
              <span style="">- TYPE D"HABITATION : <span style="color:blue;"> Maison</span>
              <span style="">- SURFACE CHAUFFÉE : <span style="color:blue;">{$contract.request.surface_home}</span>
              <span style="">- TYPE ENERGIE :<span style="color:blue;">{$contract.request.energy.value}</span>
              <span style="">- APPAREIL A REMPLACER :<span style="color:blue;"></span>
              <span style="">- Marque :<span style="color:blue;"> {$contract.forms.RENSEIGNEMENTINSTALLATION.MARQUEMATERIELDEPOSER|UPPER}</span>
              <span style="">- Modèle :<span style="color:blue;"> {$contract.forms.RENSEIGNEMENTINSTALLATION.MODELMATERIELDEPOSER|UPPER} </span>
              <span style="">- OBSERVATION SUR LE REMPLACEMENT :<span style="color:blue;"> NEANT</span>
              <br> <span style="">- DATE DE PREVISITE :<span style="color:blue;">{$contract.pre_meeting_at.ddmmyyyy} </span>
            </div>
          </td>
        </tr>
      </table>


      {if $quotation.subvention_type.commercial =="calcule_prime_cee"||  $quotation.subvention_type.commercial=="calcule_maprime_renov"|| $quotation.subvention_type.commercial=="pdf_devis_financeur"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
      <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:35px;">
        <tr>
          <th class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
            TERMES ET CONDITIONS
          </th>
        </tr>

        <tr>

          <td class="" style="padding-bottom: 0;font-size:20px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3">
            {if $quotation.subvention_type.commercial=="calcule_maprime_renov" ||  $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}

          Dans le cas où l’aide notifiée au client est inférieure au montant de l’aide prévisionnelle, l’usager n’est pas lié par le devis et l’entreprise s’engage à proposer un devis rectificatif. Le client conserve alors un droit de rétractation d’une durée de quatorze jours à partir de la date de présentation du devis rectificatif.

      L’aide MaPrimeRénov’ est conditionnelle et soumise à la conformité des pièces justificatives et informations déclarées par le bénéficiaire. En cas de fausse déclaration, de manœuvre frauduleuse ou de changement du projet de travaux subventionné, le bénéficiaire s’expose au retrait et renversement de tout ou partie de l’aide. Les services de l’Anah pourront faire procéder à tout contrôle des engagements et sanctionner le bénéficiaire et son mandataire éventuel des manquements constatés.          <br>
            {/if}

            {if  $quotation.subvention_type.commercial =="calcule_prime_cee"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"||$quotation.subvention_type.commercial=="pdf_devis_financeur"}

            {eval $polluter.comments}
            {/if}
          </td>
        </tr>
      </table>
      {/if}











      <div class="" style="margin-left:auto;margin-right:auto;position:relative;;width:94%;margin-top:40px;">
        <div class="" style="height:260px">


          <table class="Montant TailleMontant" style="width:70%;text-align:center;">
            <tr style="background-color:#b4d863;">

              <th style="background-color:#b4d86;">Total HT</th>
              <th style="background-color:#b4d86;">Total TVA <br>a 5.5%</th>
              <th style="background-color:#b4d86;">Total TVA <br>a 10%</th>
              <th style="background-color:#b4d86;">Total TVA <br>a 20%</th>
              <th style="background-color:#cae3ad">Total TVA</th>
              <th style="background-color:#b4d86;">Total TTC</th>
            </tr>
            <tr>
              <td class="">{$quotation.total_sale_without_tax}</td>
              <td style="">{$quotation.taxes["5.5"].amount}</td>
              <td style="">{$quotation.taxes["10"].amount}</td>
              <td style="">{$quotation.taxes["20"].amount}</td>
              <td style="">{$quotation.total_tax}</td>
              <td style="">{$quotation.total_sale_with_tax}</td>
            </tr>

          </table>

          <div class="" style="margin-top:60px;">
            {if $quotation.subvention_type.commercial =="calcule_prime_cee"||  $quotation.subvention_type.commercial=="calcule_maprime_renov"|| $quotation.subvention_type.commercial=="pdf_devis_financeur"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"|| $quotation.subvention_type.commercial=="pdf_devis_empty"}
            <table class="Montant TailleMontant" style="width:100%;;text-align:center;">

              <tr style="background-color:#b4d863;">

                {if $quotation.subvention_type.commercial=="pdf_devis_financeur" }
                <th style="">Accompte VERSÉE <br>PAR {$polluter.commercial}</th>
                {/if}

                {if $quotation.subvention_type.commercial =="calcule_prime_cee" || $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                <th style="">Prime C.E.E VERSÉE <br>PAR {$polluter.commercial} </th>
                {/if}

                {if $quotation.subvention_type.commercial=="calcule_maprime_renov" ||  $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                <th style="">PRIME <br>MaPrimeRénov" </th>
                {/if}
                {if $quotation.bbc_subvention > 0}
                <th style="vertical-align: top;">bbc <br></th>
                {/if}
                {if $quotation.subvention > 0}
                <th style="vertical-align: top;">passoir<br></th>
                {/if}
                {if $quotation.discount_amount > 0}
                <th style="vertical-align: top;">REMISE <br></th>
                {/if}
                {if $quotation.subvention_type.commercial =="calcule_prime_cee"||  $quotation.subvention_type.commercial=="calcule_maprime_renov"|| $quotation.subvention_type.commercial=="pdf_devis_financeur"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee" || $quotation.subvention_type.commercial=="pdf_devis_empty"}
                <th style="">NET A PAYER <br>en euros</th>
                {/if}
              </tr>

              <tr>

                {if $quotation.subvention_type.commercial =="calcule_prime_cee"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"||$quotation.subvention_type.commercial=="pdf_devis_financeur"}
                <td class="">{$quotation.cee_prime}</td>
                {/if}

                {if $quotation.subvention_type.commercial=="calcule_maprime_renov" ||  $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                <td class="">{$quotation.ana_tax} </td>
                {/if}
                {if $quotation.bbc_subvention > 0}
                <td class="">{$quotation.bbc_subvention}</td>
                {/if}
                {if $quotation.subvention > 0}
                <td class="">{$quotation.subvention}</td>
                {/if}
                {if $quotation.discount_amount > 0}
                <td class="">{$quotation.discount_amount}</td>
                {/if}

                {if $quotation.subvention_type.commercial=="pdf_devis_financeur" || $quotation.subvention_type.commercial =="calcule_prime_cee"}
                <td class="">{$quotation.ttc_cee_bbc_passoire_remise} </td>
                {/if}

                {if $quotation.subvention_type.commercial=="calcule_maprime_renov"}
                <td class="">{$quotation.ttc_anah_bbc_passoire_remise}</td>
                {/if}


                {if $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                <td class="">{$quotation.ttc_cee_anah_bbc_passoire_remise} </td>
                {/if}

                {if $quotation.subvention_type.commercial=="pdf_devis_action"}
                <td class="">{$quotation.ttc_cee_bbc_passoire_remise} </td>
                {/if}
                {if $quotation.subvention_type.commercial=="pdf_devis_empty"}
                <td class="">{$quotation.total_sale_with_tax_discount}</td>
                {/if}
              </tr>
            </table>
            {/if}


          </div>
        </div>
      </div>
      <div class="" style="margin-left:400px;margin-top:100px">


        <div style="color: #b0e539;font-size:40px;margin-left:30px;">

        </div>
        <div style="border:solid 1px black;width:720px;height:270px;margin-left:30px;border-radius:6px;  ">

          <div style="margin-top:20px;text-align: center;font-size:24px;">
            Date, Signature et mention «Bon pour Accord»
          </div>
          <div style="margin-top:20px;margin-left: 10px;font-size:24px;">
            Fait à : {$customer.address.city|upper} </div>
            <div style="margin-top:20px;margin-left: 10px;font-size:24px">
              Le :  {$contract.quoted_at.ddmmyyyy}  </div>
              <signature style="width:300px;height:70px;font-size:20px;margin:auto;margin-top:5px;text-align:center;margin-left: 5px;" name="signature">
              </signature>

            </div>
          </div>

          <footer class="footerAllPage">
            <div class="cpiEcritureDixHuit" style="">

              <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {$company.comments}
              </div>
              {if $company.picture.url}
              <div class="imgFooter">


                <img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />
              </div>
              {/if}
            </div>
            {$nbrPage=$nbrPage+1}
            <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span></div>

          </footer>
        </div>
            <script>
                var pages = document.getElementsByClassName("pageSuivante");
   
                for (var i = 0; i < pages.length; i++) {
                   pages[i].getElementsByClassName("Pager")[0].innerHTML+=(i+1)+"/"+pages.length;
                }
         
         var pages = document.getElementsByClassName("pageSuivante");
   
                for (var i = 0; i < pages.length; i++) {
                   pages[i].getElementsByClassName("Pager")[0].innerHTML+=(i+1)+"/"+pages.length;
                }
         
            </script>
         
</body>
</html>