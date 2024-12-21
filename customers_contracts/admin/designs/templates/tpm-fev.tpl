<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>

<style>
 body {
    /*font-family: arial;*/
    margin: 0px;
    font-family: times new romans;
  }
td, th {

  text-align: left;
  padding:  8px;

}
 .tableDevis th {
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;

    }
    .tableDevis td {
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    .tableDevis th,
    .tableDevis td {
      border: solid 1px black;
      font-size: 30px;
      width:200px;
      text-align: center;

    }
    .tableDevis {
      border-spacing: 0px;

    }
    .cadreDevis {

      position:relative;
      height:2250px !important;
    //    background-color: lightgrey;

    }
    .greenDiv
    {
        width: 100px;
        height: 95px;
        background: #b4d863;
        margin-left:1500px;

        border-radius: 0% 0% 0% 100%;
    }
  .PacTableInfoDevis {
      left:800px;
      position:relative;
      bottom:35px;
    }
    .container{
         margin-top: -80px;
        position:relative;
        height:1450px;
        background-color: lightblue;
      
       
    }
    .tableProduit{
      width: 1520px !important;
      margin-left:auto;
      margin-right:auto;
    //  margin-left:25px;
   //   margin-right:25px;
       /*background-color: lightblue;*/
       text-align: center;
    }
    .text-content{
       line-height: 24px;
       max-width: 70ch ;
       width: 800px;
      
       margin: 0px !important;
       text-align: justify;
       
      
    }
.theadProduit{
 background: #cae3ad;font-size:23px;text-align: center;font-weight:bold;height:50px;
}
.header{
    position:relative;
    margin-top: 30px;
    height: 550px;
    /*background-color: lightpink;*/
    }
  footer{
        position:absolute;
        height: 140px;
        
        bottom: 0!important;
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
    color: black;
    }
    .logo {
      position:absolute;
      top:60px;
      left:1400px;

      width:220px;
      height:130px;
      left:50px;
       top:62px
    }
    .logoProduct {

        position:absolute;
         margin-left: 50px;x;

        width:220px;
        height:130px;
        left:50px;

    }
.cpiEcritureDixHuit {
      font-size:18;
    }
  .imgFooter{
      position: absolute;
      bottom: 100px;
    }
  .numberOfPage {
      text-align:right;
      font-size:24px;
      left:100px

    }
.footerAllPage {
 
       position:absolute;
      bottom:15px;

      padding-left:15px;
      width:1550px;

    }
      .pageSuivante {
       page-break-after: always;
      position: relative;
     // background-color: lightgrey;
  }
</style>

</style>
</head>
<body>
    {assign var="nbrPage" value="0"}
    {assign var="totalPage" value="0"}
    {foreach $products as $product}
      {$totalPage=$totalPage+1}
    {/foreach}

      <div class="pageSuivante cadreDevis pageCompteur" style="">
        <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

        {if $company.picture}  <img class="logo"style="width:220px;height:130px;position:absolute;left:50px;top:62px" src="{$company.picture.url}" />{/if}
        <div style="">
          <table class="PacTableInfoDevis">
            <tr>
              <td>
                <div>
                  <table class="tableDevis">
                    <thead>
                      <tr>
                        <th style="">DEVIS </th>

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
          <div class="" >{$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper} {$verifs.0.number|upper}</div>
          <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
          <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
          <div class="cpiEcritureVingtQuatre" style="margin-top: 7px;">
            <span class="" style="font-weight: bold;color: #b0e539;">DELAI DE LIVRAISON :</span> 3 mois
          </div>

          <div class="cpiEcritureVingtQuatre" style=""><span style="color: #b0e539;font-weight: bold;">{$i} Offre valable j"usqu"au :</span>{if $contract.quoted_at} {$contract.quoted_at_90.ddmmyyyy} {else} {$quotation.dated_at_90.ddmmyyyy} {/if}
          </div>
        </div>
        <div class="infoEntrepriseTop infoEntrepriseGras" style="">
          <div style="">{$company.name}
          </div>
          <div style="">{$company.address1}
          </div>
          <div style="">{$company.postcode}, {$company.city}</div>
        </div>
        <div class="infoEntrepriseTop renseignementEntreprise" style="">
          TELEPHONE : {$company.phone} <br>
          SIRET : {$company.siret} <br>
          TVA INTRA : {$company.tva}<br>
          N° RGE : {$company.rge}
        </div>

        <div class="" style="margin-top: 20px;height:900px;">
          <table class="tableProduit" style="width:94%;align: center;margin-left:auto;margin-right:auto;height:100%">
            <tr style="height:4%">
              <th class="" style="background:  #cae3ad;font-size:23px;width:100%;text-align: center;font-weight:bold;">DETAILS</th>

            </tr>
                      <tr>

                        <td class="" style="vertical-align:top;line-height: 1.235;">

                          <div class="" style="font-size:21px;text-align:left;vertical-align:top;padding-left:10px;padding-top:8px;"><span style="">
                            BAR-TH-164 : Rénovation globale d'une maison individuelle de surface habitable (Shab) <span style="color: blue"> {$contract.request.surface_home} </span> , ayant un équipement de production de chaleur
                          utilisant du  <span style="color: blue"> {$contract.request.energy.value}.</span>  . <br><br>

                          L'audit énergétique a été réalisée le <span style="color: blue"> {$contract.forms.TH164.DateEtude} </span> et sous traitée par le bureau d'étude <span style="color: blue"> {$contract.forms.TH164.NomEtudeEnergetique}</span>, n° SIRET
                          <span style="color: blue"> {$contract.forms.TH164.SirenEtudeEnergetique}</span> , n° RGE <span style="color: blue"> {$contract.forms.TH164.RgeEtudeEnergetique} </span>  étude sous la référence <span style="color: blue"> {$contract.forms.TH164.NumeroEtude} </span> , en utilisant le logiciel <span style="color: blue"> {$contract.forms.TH164.NomLogiciel}</span>, version <span style="color: blue"> {$contract.forms.TH164.VersionLogiciel}.</span> <br><br>


                          Le logiciel utilise un moteur de calcul validé par le CSTB, le CEREMA basé majoritairement sur le moteur 3CL qui prend en compte les 3
                          usages suivants : Chauffage - Eau chaude sanitaire - Climatisation.
                          La formule de calcul est : (Cef initial - Cef projet) X Shab X Coefficient de bonification Coup de Pouce
                          Caractéristiques du bâtiment données par l'étude énergétique : <br><br>


                          * Cef initial : <span style="color: blue"> {$contract.request.cef} </span> kWh/m².an * Cef projet : <span style="color: blue"> {$contract.request.cef_project} </span> kWh/m².an (Consommation conventionnelle en Energie Finale avant et après les travaux de rénovations) <br><br>


                          * Cep initial : <span style="color: blue"> {$contract.request.cep} </span> kWh/m².an * Cep projet : <span style="color: blue"> {$contract.request.cep_project} </span>  kWh/m².an (Consommation conventionnelle en Energie Primaire avant et après les travaux de rénovations) <br><br>

                          - Gain énérgetique du projet par rapport à la consommation conventionnelle en énergie primaire avant travaux : <span style="color: blue"> {$contract.forms.TH164.GAINENERGETIQUE}%.</span> <br><br>


                          - Travaux incluant le changement de tous les équipements de production de chaleur (chauffage ou Eau Chaude Sanitaire) au charbon ou au
                          fioul non performants (toutes technologies autre qu'à condensation).<br><br>

                          - Les émissions de gaz à effet de serre (kgeqCO2/m²) après rénovation sont inférieures ou égales à la valeur initiale de ces émissions avant
                          travaux.
                          - Les équipements de production de chaleur chauffage ou d'eau chaude sanitaire installés utilisent plus de 40 % d'énergie renouvelable.<br><br>

                              </span></div>


                        </td>
                      </tr>



          </table>
        </div>
  <div class="" style="margin:auto;width:90%;font-size:21px">

  .Le bénéficiaire reconnait et accepte l’intervention de(s) société(s) {foreach $works as $work } {$work.layer.name}, {/foreach} FORME(S)
  JURIDIQUE(S) ET mandatée(s) par {$company.name} pour la
  réalisation des travaux suivants :


  {foreach $works as $work }
{if $work.layer.exists !== "0"}
   <br><br>


  « {$work.polluter.address2} » sous-traité auprès
  de l’entreprise {$work.layer.name}, SIRET {$work.layer.siret}, Qualification {$work.layer.rge} valable jusqu'au
  {$work.layer.rge_end_at.ddmmyyyy}, Assurance civile {$work.layer.address2}
  . Date de la visite technique : {$work.pre_meeting_at.ddmmyyyy}

{/if}
   {/foreach}

  </div>
        <footer class="footerAllPage">
          <div class="cpiEcritureDixHuit" style="">
            <div class="" style="" ><b>  {$company.name}</b> <br>
              {$company.address1}, {$company.postcode} {$company.city}<br>
              Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
            </div>
            {if $company.picture.url}
            <div class="imgFooter">               {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
            </div>
            {/if}
          </div>
          {$nbrPage=$nbrPage+1}
          <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span>
          </div>
        </footer>
      </div>


    <div class="pageSuivante cadreDevis ProductsAndItems pageCompteur">

  <div class="greenDiv">  <div id="info"></div> </div>

  <div class="header">
       {if $company.picture}  <img class="logoProduct" src="{$company.picture.url}" />{/if}
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



      <div class="infoClient" style="">
        <div class="" style="font-size:29px;font-weight:bold">CLIENT</div>
        <div id="info"></div>
        <div class="" >{$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper} {$verifs.0.number|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
        <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
        <div class="cpiEcritureVingtQuatre" style="margin-top: 7px;">
          <span class="" style="font-weight: bold;color: #b0e539;">DELAI DE LIVRAISON :</span> 3 mois
        </div>

        <div class="cpiEcritureVingtQuatre" style=""><span style="color: #b0e539;font-weight: bold;">{$i} Offre valable j"usqu"au :</span>{if $contract.quoted_at} {$contract.quoted_at_90.ddmmyyyy} {else} {$quotation.dated_at_90.ddmmyyyy} {/if}
        </div>
      </div>
      <div class="infoEntrepriseTop infoEntrepriseGras" style="margin-top: -80px;">

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

      <div class="container" style="" >
             <table id ="table-0" class="tableProduit">
            <thead class="theadProduit" >
              <th style="width:60%;">DETAILS </th>
              <th style="width:10%;">TVA</th>
              <th style="width:10%;">QTE</th>
              <th style="width:10%;">P.U. HT</th>
              <th style="width:10%;">TOTAL HT</th>
            </thead>
            <tbody>
      {foreach $products as $product name=test}

            {foreach $product.items as $items}

            {if $items.item.input1!=="calcule_maprime_renov" && $items.item.input1!=="calcule_prime_cee"  && $items.item.input1!=="pdf_devis_financeur"&& $items.item.input1!=="pdf_devis_remise"
            && $items.item.input1!=="financial_descent"&& $items.item.input1!=="pdf_devis_action" && $items.item.input1!=="double_page"}

              <tr>
                 <td class="" style="vertical-align:top;">
                     
                <div class="text-content" style="font-size:22px;text-align:left;vertical-align:top;background: #f2f2f2;text-transform: uppercase;text-align:center;margin-top:12px;"><span style="">référence:</span>{$items.item.input1}</div>
                <div class="text-content" style="font-size:22px;text-align:left;vertical-align:top;text-transform: uppercase ;padding-left:10px;padding-top:10px;"><span style="">désignation: </span>{eval $items.item.description}</div>

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
              Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}

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
                          
 </div>


  <script>
 
                                  var nbrTable=0;
                                  var height_of_rows =0;
                                  var table =  document.getElementById("table-"+nbrTable);
                                  var total =table.getElementsByTagName('tbody')[0].offsetHeight/1400;
                               //  document.getElementById("info").innerHTML+="---total---"+(Math.ceil(total))+"------";
                                 
                                   for(j = 0; j < Math.ceil(total); j++) {

                                     var rows = document.querySelectorAll('#table-'+nbrTable+' tbody tr'); 
                                     
                                    
                                    
                                     var cadre_devis = document.createElement('div');
                                     cadre_devis.setAttribute('class', 'pageSuivante cadreDevis pageCompteur');

                                     var greenDiv = document.createElement('div');//greenDiv
                                     greenDiv.setAttribute('class', 'greenDiv');

                                     var container = document.createElement('div');
                                     container.setAttribute('class', 'container');

                                     var thead= document.getElementsByClassName("theadProduit")[0]//theadProduit
                                    

                                     var mytable = document.createElement('table');
                                     nbrTable=nbrTable+1;
                                     mytable.setAttribute('id', 'table-'+nbrTable);//tableProduit
                                     mytable.setAttribute('class', 'tableProduit');
                                     mytable.createTHead();
                                     mytable.createTBody();
                                     
                                        for(i = 0; i < rows.length; i++) {

                                               height_of_rows +=rows[i].clientHeight ;   
                                             
                                               if(height_of_rows>1400)
                                               {
                                                   
                                                //  rows[i].cells[1].innerHTML+="--"+j+"--"+rows[i].offsetHeight; 
                                                //  height_of_rows=0;
                                                  var tr =rows[i].cloneNode(true);
                                                  rows[i].remove();
                                                  mytable.getElementsByTagName('tbody')[0].appendChild(tr);
                                                
                                               }
                                         }
                                     
                                   
                                    document.getElementsByTagName('body')[0].appendChild(cadre_devis);

                                    var footer = document.getElementsByClassName("footerAllPage")[0];                                              
                                    var header = document.getElementsByClassName("header")[0];
                                   
                                    cadre_devis.insertBefore(header.cloneNode(true), cadre_devis.firstChild);
                                    cadre_devis.insertBefore(greenDiv.cloneNode(true), cadre_devis.firstChild);
                                    mytable.insertBefore(thead.cloneNode(true), mytable.firstChild);
                                    container.appendChild(mytable); 
                                    cadre_devis.appendChild(footer.cloneNode(true));   
                                    cadre_devis.appendChild(container);    
                                   
                                    if(mytable.offsetHeight<80)
                                    {
                                      //  document.getElementById("info").innerHTML+="---H::"+mytable.offsetHeight+"---<br>---";
                                      cadre_devis.remove();
                                    } 
                                   
                                    height_of_rows =0;
                                 
                                  } 
                                    
                                    var tables = document.getElementsByClassName("tableProduit");

                                            for (var i = 0; i < tables.length; i++) {
                                                var rows=tables[i].rows;
                                                for (var j = 0; j < rows.length; j++) {
                                                   
                                                     rows[j].cells[1].innerHTML+=rows[j].offsetHeight; 
                                       
                                                }
                                           document.getElementById("info").innerHTML+="//"+(tables[i].offsetHeight);
                                    } 

                                    </script>
    <div class="cadreDevis pageSuivante pageCompteur">
      <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

      {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
              {if $quotation.taxes["5.5"]}
              <th style="background-color:#b4d86;">Total TVA <br>a 5.5%</th>
                {/if}
              {if $quotation.taxes["10"]}
              <th style="background-color:#b4d86;">Total TVA <br>a 10%</th>
                {/if}
              {if $quotation.taxes["20"]}
              <th style="background-color:#b4d86;">Total TVA <br>a 20%</th>
                {/if}
              <th style="background-color:#cae3ad">Total TVA</th>
              <th style="background-color:#b4d86;">Total TTC</th>
            </tr>
            <tr>
              <td class="">{$quotation.total_sale_without_tax}</td>
              {if $quotation.taxes["5.5"]}
              <td style="">{$quotation.taxes["5.5"].amount}</td>
                {/if}
              {if $quotation.taxes["10"]}

              <td style="">{$quotation.taxes["10"].amount}</td>
                {/if}
              {if $quotation.taxes["20"]}
              <td style="">{$quotation.taxes["20"].amount}</td>
              {/if}
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
                Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
              </div>
              {if $company.picture.url}
              <div class="imgFooter">


                {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
              </div>
              {/if}
            </div>
            {$nbrPage=$nbrPage+1}
            <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span></div>

          </footer>
        </div>





        <div class="cadreDevis pageSuivante pageCompteur">
          <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

          {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
            <div class="" style="font-weight: bold;">CLIENT</div>
            <div class="" > {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper}</div>
            <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
            <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
          </div>
          <div class="infoEntrepriseTop infoEntrepriseGras">

            <div style="">{$company.name}</div>
            <div style="">{$company.address1}</div>
            <div style="">{$company.postcode}, {$company.city}</div>
          </div>


          <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:35px;position:relative;">
            <tr >
              <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
                MODALITÉ DE PAIEMENTS
              </td>
            </tr>

            <tr>
              <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3;height:240px;">
                Je soussigné {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper} accepter les modalités de paiement suivantes : <br>
                MONTANT DU DEVIS : <span style="color:blue;"> {$quotation.total_sale_with_tax}  </span> <br>

                {if $quotation.subvention_type.commercial =="calcule_prime_cee"||  $quotation.subvention_type.commercial=="calcule_maprime_renov"|| $quotation.subvention_type.commercial=="pdf_devis_financeur"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"|| $quotation.subvention_type.commercial=="pdf_devis_empty"}

                {if $quotation.subvention_type.commercial=="pdf_devis_financeur" }
                Accompte VERSÉE PAR {$polluter.commercial} : <span style="color:blue"> {$quotation.cee_prime} </span> <br>
                {/if}

                {if $quotation.subvention_type.commercial =="calcule_prime_cee"|| $quotation.subvention_type.commercial=="pdf_devis_action"|| $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                MONTANT DU CEE : <span style="color:blue"> {$quotation.cee_prime} </span> versé par l"obligé directement au professionnel <br>
                {/if}

                {if $quotation.subvention_type.commercial=="calcule_maprime_renov" ||  $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                MONTANT PRIME MaPrimeRénov" : <span style="color:blue"> {$quotation.ana_tax}  </span><br>
                {/if}


                {if $quotation.discount_amount > 0}
                REMISE: <span style="color:blue"> {$quotation.discount_amount}  </span><br>
                {/if}


                RESTE À PAYER : <span style="color:blue">
                  {if $quotation.subvention_type.commercial=="pdf_devis_financeur" || $quotation.subvention_type.commercial =="calcule_prime_cee"}
                  {$quotation.ttc_cee_bbc_passoire_remise}
                  {/if}

                  {if $quotation.subvention_type.commercial=="calcule_maprime_renov"}
                  {$quotation.ttc_anah_bbc_passoire_remise}
                  {/if}

                  {if $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
                  {$quotation.ttc_cee_anah_bbc_passoire_remise}
                  {/if}
                  {if $quotation.subvention_type.commercial=="pdf_devis_empty"}
                  {$quotation.total_sale_with_tax_discount}
                  {/if}

                  {if $quotation.subvention_type.commercial=="pdf_devis_action"}
                  {$quotation.ttc_cee_bbc_passoire_remise}
                  {/if}
                </span>  payable en une à trois mensualités <br>  Modalité de paiement remis à l’installateur le jour de l’installation:<br>



                <div style="left:1040px;bottom:100px;position:absolute;"> <div style="border:solid;width:15px;height:15px;position:absolute;"></div>
                <div style="left:30px;position:relative"> Cheque </div> <div style="border:solid;width:15px;height:15px;position:absolute;"></div>
                <div class="" style="left:30px;position:relative">Espece</div>
                <div style="border:solid;width:15px;height:15px;position:absolute;"></div><div class="" style="left:30px;position:relative">Financeur </div>
                <div style="border:solid;width:15px;height:15px;position:absolute;"><span style="position:relative;bottom:5px;">X</span></div><div class="" style="left:30px;position:relative">Subvention </div>
              </div>


              {if $quotation.subvention_type.commercial=="calcule_maprime_renov" ||  $quotation.subvention_type.commercial=="calcule_maprime_renov_cee"}
              Cette offre est cumulable avec l"aide :   MaPrimeRénov" d"un montant prévisionnelle de <span style="color:blue"> {$quotation.ana_tax} </span>
              <br> Source : https://maprimerenov.gouv.fr/ <br>
              {/if}


              {/if}

            </td>
          </tr>
        </table>


        {if $contract.forms.FINANCEMENT.AVECFINANCEMENT == "OUI"}

        <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:20px;position:relative;">
          <tr>
            <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
              <b>PAIEMENT AVEC FINANCEMENT BANCAIRE (Option "Financeur" a cocher dans modalité de paiement)</b>
            </td>
          </tr>

          <tr>
            <td class="" style="padding-bottom: 0;font-size:25px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3">
              Le client a opté pour un financement bancaire sous réserve <br>
              de l"acceptation du dossier de demande de prêt auprès <br>
              de l"établissement financier ci-après: <br>
              Organisme bancaire :<span style="color:blue"> {$contract.forms.FINANCEMENT.ORGANISMEBANCAIRE}</span><br>
              Une offre préalable de crédit a été remise au client aux conditions principales suivantes :

              <table style="margin-top: 15px;font-size:25px;">
                <tr>
                  <td style="width: 640px;border:hidden;">
                    Montant du prêt : <span style="color:blue"> {$contract.forms.FINANCEMENT.MONTANTDUPRET}</span><br> Taux débiteur fixe : <span style="color:blue"> {$contract.forms.FINANCEMENT.TAUXDEBITEUR}</span>
                    %<br>Nombre d"échéances : <span style="color:blue"> {$contract.forms.FINANCEMENT.NOMBREDECHEANCES}</span>
                    <br> Périodicité :<span style="color:blue">  {$contract.forms.FINANCEMENT.PERIODICITE}</span>
                    <br>
                  </td>
                  <td style="width: 800px;padding-left: 50px;border:hidden;">
                    Report : <span style="color:blue"> {$contract.forms.FINANCEMENT.REPORT}</span> <br>
                    cout du financement : <span style="color:blue"> {$contract.forms.FINANCEMENT.coutdufinancement}</span>
                    <br>
                    Taux annuel effectif global (TAEG) :<span style="color:blue">  {$contract.forms.FINANCEMENT.TAEG}</span>
                    <br>
                    Montant des échéances :<span style="color:blue"> {$contract.forms.FINANCEMENT.MONTANTECHEANCE} €</span><br>
                    Apports personnels : <span style="color:blue"> {$contract.forms.FINANCEMENT.APPORTSPERSONNELS} € </span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        {/if}


        <div style="border:solid 1px black;width:720px;height:270px;margin-left:auto;margin-right:auto;margin-top:60px">

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

            <div style="width: 100%;;padding: 0;font-size:24px;margin-top:50px;">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
            <div style="margin-top: 40px;font-size:24px">
              <div style="margin-left:70px;" ><b>BORDEREAU DE RÉTRACTATION</b></div>

              <div style="border:1px solid #000;width: 90%;height: 460px;margin: auto;margin-top: 10px;padding: 10px;">
                <div style="">Le consommateur dispose d"un délai de quatorze jours pour exercer son droit de rétractation d"un contrat conclu à distance, à la suite d"un démarchage téléphonique ou hors établissement, sans avoir à motiver sa décision ni à supporter d"autres coûts que ceux prévus aux articles L. 221-18 à L. 221-29.</div>
                <div style="margin-top: 15px;">Numéro de devis : .............................................</div>
                <div style="margin-top: 15px;">A l"attention de la société {$company.name}</div>
                <div style="margin-top: 15px;">Je vous notifie par la présente ma rétractation du devis portant sur la vente du bien ci-dessous :</div>
                <div style="margin-top: 15px;">Commande reçu le ...............................................</div>
                <div style="margin-top: 15px;">Nom du consommateur : ..........................................</div>
                <div style="margin-top: 15px;">Adresse du consommateur : ......................................</div>
                <div style="margin-top: 15px;">Signature du consommateur :</div>
              </div>
            </div>

            <footer class="footerAllPage">
              <div class="cpiEcritureDixHuit" style="">
                <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                  Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                </div>
                {if $company.picture.url}
                <div class="imgFooter">


                  {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                </div>
                {/if}
              </div>
               {$nbrPage=$nbrPage+1}
              <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span></div>

            </footer>
          </div>
          {foreach $products as $product name=test}
          {foreach $product.items as $items}

          {if $items.item.input1=="double_page"}

          <div class="cadreDevis pageSuivante pageCompteur">
            <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

            {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                    <br> <span style="">- DATE DE PREVISITE :<span style="color:blue;"> {$contract.pre_meeting_at.ddmmyyyy}</span>
                  </div>
                </td>
              </tr>
            </table>



            <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:35px;">
              <tr>
                <th class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
                  TERMES ET CONDITIONS
                </th>
              </tr>

              <tr>

                <td class="" style="padding-bottom: 0;font-size:20px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3">

                  {eval $polluter.comments}



                </td>
              </tr>
            </table>







            <div class="" style="margin-left:auto;margin-right:auto;position:relative;;width:94%;margin-top:40px;">
              <div class="" style="height:260px">


                <table class="Montant TailleMontant" style="width:70%;text-align:center;">
                  <tr style="background-color:#b4d863;">

                    <th style="background-color:#b4d86;">Total HT</th>
                    {if $quotation.taxes["5.5"]}
                    <th style="background-color:#b4d86;">Total TVA <br>a 5.5%</th>
                      {/if}
                    {if $quotation.taxes["10"]}
                    <th style="background-color:#b4d86;">Total TVA <br>a 10%</th>
                      {/if}
                    {if $quotation.taxes["20"]}
                    <th style="background-color:#b4d86;">Total TVA <br>a 20%</th>
                      {/if}
                    <th style="background-color:#cae3ad">Total TVA</th>
                    <th style="background-color:#b4d86;">Total TTC</th>
                  </tr>
                  <tr>
                    <td class="">{$quotation.total_sale_without_tax}</td>
                    {if $quotation.taxes["5.5"]}
                    <td style="">{$quotation.taxes["5.5"].amount}</td>
                      {/if}
                    {if $quotation.taxes["10"]}

                    <td style="">{$quotation.taxes["10"].amount}</td>
                      {/if}
                    {if $quotation.taxes["20"]}
                    <td style="">{$quotation.taxes["20"].amount}</td>
                    {/if}
                    <td style="">{$quotation.total_tax}</td>
                    <td style="">{$quotation.total_sale_with_tax}</td>
                  </tr>

                </table>

                <div class="" style="margin-top:60px;">

                  <table class="Montant TailleMontant" style="width:100%;;text-align:center;">

                    <tr style="background-color:#b4d863;">




                      <th style="">Prime C.E.E VERSÉE <br>PAR {$polluter.commercial}</th>




                      <th style="">NET A PAYER <br>en euros</th>

                    </tr>

                    <tr>


                      <td class="">{$quotation.cee_prime}</td>

                      <td class="">{$quotation.ttc_cee_bbc_passoire_remise} </td>

                    </tr>
                  </table>



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
                      Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                    </div>
                    {if $company.picture.url}
                    <div class="imgFooter">


                      {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                    </div>
                    {/if}
                  </div>
                  {$nbrPage=$nbrPage+1}
                  <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span></div>

                </footer>
              </div>

              <div class="cadreDevis pageSuivante pageCompteur">
                <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

                {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                  <div class="" style="font-weight: bold;">CLIENT</div>
                  <div class="" > {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper}</div>
                  <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
                  <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
                </div>
                <div class="infoEntrepriseTop infoEntrepriseGras">

                  <div style="">{$company.name}</div>
                  <div style="">{$company.address1}</div>
                  <div style="">{$company.postcode}, {$company.city}</div>
                </div>


                <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:35px;position:relative;">
                  <tr >
                    <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
                      MODALITÉ DE PAIEMENTS
                    </td>
                  </tr>

                  <tr>
                    <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3;height:240px;">
                      Je soussigné {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper} accepter les modalités de paiement suivantes : <br>
                      MONTANT DU DEVIS : <span style="color:blue;"> {$quotation.total_sale_with_tax}  </span> <br>


                      MONTANT DU CEE : <span style="color:blue"> {$quotation.cee_prime} </span> versé par l"obligé directement au professionnel <br>



                      RESTE À PAYER : <span style="color:blue">

                        {$quotation.ttc_cee_bbc_passoire_remise}


                      </span>  payable en une à trois mensualités <br>  Modalité de paiement remis à l’installateur le jour de l’installation:<br>



                      <div style="left:1040px;bottom:100px;position:absolute;"> <div style="border:solid;width:15px;height:15px;position:absolute;"></div>
                      <div style="left:30px;position:relative"> Cheque </div> <div style="border:solid;width:15px;height:15px;position:absolute;"></div>
                      <div class="" style="left:30px;position:relative">Espece</div>
                      <div style="border:solid;width:15px;height:15px;position:absolute;"></div><div class="" style="left:30px;position:relative">Financeur </div>
                      <div style="border:solid;width:15px;height:15px;position:absolute;"><span style="position:relative;bottom:5px;">X</span></div><div class="" style="left:30px;position:relative">Subvention </div>
                    </div>




                  </td>
                </tr>
              </table>


              {if $contract.forms.FINANCEMENT.AVECFINANCEMENT == "OUI"}

              <table class="tableProduit" style=";width:94%;margin-left:auto;margin-right:auto;margin-top:20px;position:relative;">
                <tr>
                  <td class="" style="padding-bottom: 0;font-size:22px;text-align: left;background: #f2f2f2;text-align:center;">
                    <b>PAIEMENT AVEC FINANCEMENT BANCAIRE (Option "Financeur" a cocher dans modalité de paiement)</b>
                  </td>
                </tr>

                <tr>
                  <td class="" style="padding-bottom: 0;font-size:25px;text-align: left;padding-left:10px;padding-top:5px;line-height: 1.3">
                    Le client a opté pour un financement bancaire sous réserve <br>
                    de l"acceptation du dossier de demande de prêt auprès <br>
                    de l"établissement financier ci-après: <br>
                    Organisme bancaire :<span style="color:blue"> {$contract.forms.FINANCEMENT.ORGANISMEBANCAIRE}</span><br>
                    Une offre préalable de crédit a été remise au client aux conditions principales suivantes :

                    <table style="margin-top: 15px;font-size:25px;">
                      <tr>
                        <td style="width: 640px;border:hidden;">
                          Montant du prêt : <span style="color:blue"> {$contract.forms.FINANCEMENT.MONTANTDUPRET}</span><br> Taux débiteur fixe : <span style="color:blue"> {$contract.forms.FINANCEMENT.TAUXDEBITEUR}</span>
                          %<br>Nombre d"échéances : <span style="color:blue"> {$contract.forms.FINANCEMENT.NOMBREDECHEANCES}</span>
                          <br> Périodicité :<span style="color:blue">  {$contract.forms.FINANCEMENT.PERIODICITE}</span>
                          <br>
                        </td>
                        <td style="width: 800px;padding-left: 50px;border:hidden;">
                          Report : <span style="color:blue"> {$contract.forms.FINANCEMENT.REPORT}</span> <br>
                          cout du financement : <span style="color:blue"> {$contract.forms.FINANCEMENT.coutdufinancement}</span>
                          <br>
                          Taux annuel effectif global (TAEG) :<span style="color:blue">  {$contract.forms.FINANCEMENT.TAEG}</span>
                          <br>
                          Montant des échéances :<span style="color:blue"> {$contract.forms.FINANCEMENT.MONTANTECHEANCE} €</span><br>
                          Apports personnels : <span style="color:blue"> {$contract.forms.FINANCEMENT.APPORTSPERSONNELS} € </span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              {/if}


              <div style="border:solid 1px black;width:720px;height:270px;margin-left:auto;margin-right:auto;margin-top:60px">

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

                  <div style="width: 100%;;padding: 0;font-size:24px;margin-top:50px;">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
                  <div style="margin-top: 40px;font-size:24px">
                    <div style="margin-left:70px;" ><b>BORDEREAU DE RÉTRACTATION</b></div>

                    <div style="border:1px solid #000;width: 90%;height: 460px;margin: auto;margin-top: 10px;padding: 10px;">
                      <div style="">Le consommateur dispose d"un délai de quatorze jours pour exercer son droit de rétractation d"un contrat conclu à distance, à la suite d"un démarchage téléphonique ou hors établissement, sans avoir à motiver sa décision ni à supporter d"autres coûts que ceux prévus aux articles L. 221-18 à L. 221-29.</div>
                      <div style="margin-top: 15px;">Numéro de devis : .............................................</div>
                      <div style="margin-top: 15px;">A l"attention de la société {$company.name}</div>
                      <div style="margin-top: 15px;">Je vous notifie par la présente ma rétractation du devis portant sur la vente du bien ci-dessous :</div>
                      <div style="margin-top: 15px;">Commande reçu le ...............................................</div>
                      <div style="margin-top: 15px;">Nom du consommateur : ..........................................</div>
                      <div style="margin-top: 15px;">Adresse du consommateur : ......................................</div>
                      <div style="margin-top: 15px;">Signature du consommateur :</div>
                    </div>
                  </div>

                  <footer class="footerAllPage">
                    <div class="cpiEcritureDixHuit" style="">
                      <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                        Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                      </div>
                      {if $company.picture.url}
                      <div class="imgFooter">


                        {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                      </div>
                      {/if}
                    </div>
                    {$nbrPage=$nbrPage+1}
                    <div class="numberOfPage" style="margin-top:-40px;"><span class="Pager">Page </span></div>

                  </footer>
                </div>
                {/if}
                {/foreach}
                {/foreach}





                <div class=" cadreDevis pageSuivante" >
                  <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>

                  {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                    <div class="" style="font-weight: bold;">CLIENT</div>
                    <div class="" > {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper}</div>
                    <div class="" style="margin-top: 5px;">{$customer.address.address1|upper}</div>
                    <div class="" style="margin-top: 5px;">{$customer.address.postcode|upper} {$customer.address.city|upper}</div>
                  </div>
                  <div class="infoEntrepriseTop infoEntrepriseGras">

                    <div style="">{$company.name}</div>
                    <div style="">{$company.address1}</div>
                    <div style="">{$company.postcode}, {$company.city}</div>
                  </div>

                  <div class="content" style="">
                    <h1><i>INFORMATIONS PRE CONTRACTUELLES DU CONSOMMATEUR</i></h1>

                    <div class="block" style="margin-top:30px;">

                      Il est expressément indiqué que les documents pré-contractuels et contractuels seront fournis au consommateur, le jour des traveaux par l"équipe d"installation ou sur <br> <b> un support durable :</b>un courriel comprenant en pièce jointe un fichier au
                      format PDF qui fera l’objet d’une signature électronique via la société YOUSIGN. En acceptant ce devis, le consommateur donne son accord exprès pour la fourniture des documents sur ce support.

                    </div>
                    <div class="block">

                      Si le consommateur souhaite que l"exécution d"une prestation de services commence avant la fin du délai de rétractation mentionné à l"article L.221-18, le professionnel recueille sa demande expresse sur papier sur support durable conformément à l"article L.221-28 du Code de la  consommation.

                    </div>
                    <div class="block">

                      <b>
                        Le traitement des réclamations :</b> Contacter notre service-client par courriel à l’adresse suivante {$company.email} ou par courrier postal : {$company.name}– {$company.address1} – {$company.postcode} {$company.city}.
                        La demande sera traitée dans les meilleurs délais.

                      </div>
                      <div class="block" style="margin-top:50px;position:relative">
                        <b>Litiges :</b> En cas de litige ou de désaccord dans l’application du présent contrat, le consommateur adressera une lettre en RAR à l’entreprise qui aura 15 (quinze) jours pour la prise en compte de la demande, passé ce délai le consommateur peut saisir le médiateur pour trouver un accord amiable et gratuit.
                        Le consommateur a la possibilité de recourir à la procédure de Médiation de la Consommation, Articles L611-1 et suivants Code Consommation :
                        <div style="position:relative;top:10px"><span style="x;color:red">-------------------------------------------------------------------------------------------------------------------------------------------------------------</span></div>


                        <br>  En cas de contestation de quelque nature que ce soit, en référence des lois françaises applicables et attribution de juridiction du ressort du Tribunal Judiciaire où des instances compétentes.
                      </div>

                      <div class="block" style="margin-top:50px;">

                        <b>  Liste d’opposition au démarchage téléphonique :</b> le consommateur qui ne souhaite pas faire l’objet de prospection commerciale par voie téléphonique peut s’inscrire sur le service<span style="color:blue;text-decoration:underline;"> www.bloctel.gouv.fr.</span> Ce service est gratuit et
                        respecte vos données personnelles.

                      </div>
                      <div class="block" style="margin-top:50px;">
                        <b>
                          RGPD (règlement général sur la protection des données) : </b>la société {$company.name} applique la clause de confidentialité et protection des données.
                          L’utilisation de vos données : Nom, Prénom, adresse, téléphone, adresse courriel, sont utilisées uniquement dans le cadre de la relation du contrat pour sa bonne exécution. Le consommateur accepte le transfert de ses données : adresse du chantier pour les livraisons.
                          Droit d’opposition : le consommateur peut s’opposer à figurer dans notre fichier après la finalisation du contrat. Notre société ne diffuse aucune donnée de ses clients. Le consommateur a un droit d’accès à sa fiche client, sur simple demande une copie lui sera transmise.


                        </div>
                        <div class="block" style="margin-top:50px;">
                          <b>
                            Le consommateur peut rectifier les informations inexactes le concernant.
                            Le consommateur a un droit d’effacement des données sur simple demande, après la fin du contrat.
                            Notre société respecte le droit à la limitation du traitement des données.

                          </b>
                        </div>

                      </div>
                      <footer class="footerAllPage">
                        <div class="cpiEcritureDixHuit" style="">
                          <div class="" style=""><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                            Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                          </div>
                          {if $company.picture.url}
                          <div class="imgFooter">


                            {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                          </div>
                          {/if}
                        </div>


                      </footer>
                    </div>

                    <div class="pageSuivante cadreCondition"  style="color: #000;">
                      <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>
                      {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                                      <td style="tableDevis">{$quotation.reference}</td>

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
                      <table style="margin-top: -10px;width:1450px;margin-right:auto;margin-left:auto;">
                        <tr>
                          <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                            <p><b>CONDITIONS GENERALES DEVIS</b></p>
                            <p><b>1- DISPOSITIONS GENERALES</b></p>
                            Les présentes conditions générales de vente sont
                            applicables à toutes les ventes de chaudières, chauffeeau, pompes à chaleurs, climatiseurs, adoucisseurs,
                            appareils et tout autre équipement, pièces de rechange et
                            accessoires (ci-après dénommés les « Equipements »)
                            par {$company.name} (ci-après dénommée la «
                            Société ») pour une livraison en France métropolitaine,
                            ainsi qu’à toutes prestations d’installation, de
                            remplacement et de réparation des Equipements (ci-après
                            dénommés les « Prestations de service ») effectuées par
                            la Société.
                            Les présentes conditions générales de ventes sont
                            applicables aux seuls consommateurs, au sens qu’en
                            donne l’article liminaire du Code de la consommation,
                            agissant exclusivement pour leur propre compte et ayant
                            la pleine capacité juridique de contracter (ci-après
                            dénommés le/les «Client(s)».
                            Le Client déclare avoir pris connaissance des présentes
                            conditions générales de vente avant la passation de sa
                            commande. La validation de sa commande et donc la
                            conclusion du contrat de vente des Equipements et des
                            Prestations de services vaut ainsi acceptation sans
                            restriction ni réserve des présentes conditions de vente.
                            Aucune des clauses portées sur les devis signés ou sur
                            les correspondances adressées par le Client à la Société
                            ne peut en conséquence y déroger, sauf acceptation
                            préalable et écrite de la Société.
                            L’intervention de la Société se limite expressément à la
                            fourniture des Equipements et aux Prestations de services
                            spécifiées au devis.
                            Le Client est informé qu’il peut conserver les équipements
                            usagés complets et démontés, sauf avis contraire de sa
                            part.
                            <p><b>2 - IDENTIFICATION DE L’AUTEUR DE L’OFFRE</b></p>
                            <div style="border: 1px solid #000;text-align: center;padding: 5px; ">
                              Société {$company.name}
                              , au capital de {$company.capital} euros, immatriculée au
                              Registre du commerce et des Sociétés de
                              sous le numéro {$company.siret}
                              Siège social :{$company.address1}, {$company.postcode} {$company.city}
                            </div>
                            <p><b>3- DEVIS</b></p>
                            Le devis est une offre de prix des Equipements et /ou des
                            Prestations de services proposés par la Société au Client
                            à titre gratuit. Le devis est valable à compter de la date
                            figurant en-tête du devis et pour la durée indiquée sur le
                            devis, remis par la Société au Client. Une fois ce délai
                            écoulé, le devis devient caduc.
                            <p><b>4- COMMANDES ET CONCLUSION DU CONTRAT</b></p>
                            La signature du devis par le Client vaut commande par
                            celui-ci. Le contrat de vente des Equipements et/ou de
                            Prestations de services est conclu au moment de la
                            signature du devis par le Client et la Société. Sous réserve
                            des dispositions visées sous l’article 8 « Droit de
                            rétractation », aucune commande ne pourra être annulée,
                            même partiellement, lorsqu’elle est en cours d’opération.
                            Le devis est établi sur la base d’un environnement ne
                            comportant pas d’amiante. Dans le cas contraire, le devis
                            même signé devient caduc et la Société, selon les cas,
                            soit établira un devis intégrant la gestion de l’amiante si
                            cela est réalisable par ses soins ou un de ses soustraitants, soit exercera son droit de retrait motivé envers le
                            Client.
                            <p><b>5- PRIX</b></p>
                            Les prix des Equipements et des Prestations de service
                            sont exprimés en euros et s’entendent toutes taxes et
                            contributions environnementales comprises. La TVA est
                            appliquée au taux en vigueur au moment de la passation
                            de la commande.
                            Pour bénéficier du taux de T.V.A. réduit, le Client s’engage
                            à compléter l’attestation prévue à cet effet. Le Client qui
                            fournirait des informations erronées à la Société et aurait


                          </td>
                          <td style="width:220px;font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                            pu ainsi bénéficier indûment du taux réduit de T.V.A. sur
                            les travaux demandés, engagerait sa responsabilité
                            auprès de l’administration fiscale : il s’exposerait ainsi à
                            payer à l’administration fiscale le complément de T.V.A.
                            légalement dû (soit la différence entre le taux normal et le
                            taux réduit).
                            <p><b>6-DELAI DE LIVRAISON</b></p>
                            En dehors de cas d’achat financé au moyen d’un crédit
                            affecté, la Société s’engage à livrer les Equipements et/
                            ou exécuter les Prestations de service dans un délai
                            maximal fixé à 21 jours à compter de la réception par la
                            Société du devis signé par le client auquel il convient
                            d’ajouter les 14 jours correspondant au délai de
                            rétractation dont le Client dispose pour renoncer à sa
                            commande conformément à l’article L.221-18 du Code de
                            la consommation. En cas d’achat financé au moyen d’un
                            crédit affecté, ce délai court à partir de l’acceptation du
                            dossier par la banque. La livraison et l’installation des
                            Equipements donneront obligatoirement lieu à
                            l’établissement d’un bon signé par le livreur/l’installateur et
                            le Client. Dans ce(s) bon(s), le Client pourra, le cas
                            échéant, faire des réserves notamment relatives aux
                            Équipements.
                            Conformément aux dispositions de l’article L. 216-2 du
                            Code de la consommation, le Client peut dénoncer le
                            contrat par lettre recommandée avec demande d’avis de
                            réception ou par un écrit sur un autre support durable, si,
                            après avoir enjoint, selon les mêmes modalités, la Société
                            d’effectuer la livraison dans un délai supplémentaire
                            raisonnable, cette dernière ne s’est pas exécutée dans ce
                            délai.
                            Ce contrat est, le cas échéant considéré comme rompu à
                            la réception, par la Société, de la lettre par laquelle le
                            Client l’informe de sa décision, à moins que la Société ne
                            se soit exécutée entre-temps.
                            Le Client peut immédiatement résoudre le contrat lorsque
                            la Société refuse d’effectuer la livraison ou lorsqu’elle
                            n’exécute pas son obligation de livraison des
                            Equipements à la date où ce délai constitue pour le Client
                            une condition essentielle du contrat. Cette condition
                            essentielle résulte d’une demande expresse et écrite du
                            Client avant la conclusion du contrat.
                            <p><b>7- CONDITIONS DE REGLEMENT ET FACTURATION</b></p>

                            <p><b><u>7.1- Paiement comptant (sans financement par un
                              crédit affecté) des Equipements (hors pièces de
                              rechange et accessoires)</u></b></p>
                              Sauf dispositions contraires prévues au devis et en dehors
                              des cas où le Client a opté pour un financement affecté tel
                              que défini au 7.2, le prix de la commande devra être réglé
                              en deux fois par le Client :
                              - Acompte réglé par espèce ou chèque correspondant
                              à trente pour cent (30%) du prix total de la
                              commande ;
                              - Solde de la commande réglé par chèque lors de la
                              mise en service de l’Equipement chez le Client.
                              Tout retard de paiement entraine automatiquement
                              l’application de pénalités. Les pénalités sont calculées sur
                              la base du montant de la facture TTC du Client au taux
                              légal en vigueur multiplié par trois. Les pénalités sont
                              encourues à partir du jour suivant l’échéance de la facture
                              et jusqu'au jour de son règlement total.

                              <p><b><u>7.2- Paiement par un crédit affecté des Equipements
                                (hors pièces de rechange et accessoires)</u></b></p>
                                Le Client peut financer son achat d’un Equipement par un
                                crédit à la consommation affecté au sens de l’article L.
                                311-1 du Code de la consommation.
                                Pour ce faire, le Client se voit remettre l’information
                                précontractuelle nécessaire préalablement à la conclusion
                                du contrat de crédit avec le partenaire financier de la

                              </td>
                              <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                Société. Dans ce cas, la vente de l’Equipement ne
                                deviendra définitive qu’au moment où l’offre de crédit
                                deviendra elle-même définitive.
                                Le financement de l’achat par un crédit affecté au sens de
                                l’article L. 311-1 du Code de la consommation entrainera
                                l’application des dispositions des articles L. 312-45 à L.
                                312-56 du même code (ci-après reproduits) :

                                <p><b><u>Article L. 312-45 du Code de la consommation :</u></b></p>
                                « Chaque fois que le paiement du prix est acquitté, en tout
                                ou partie, à l'aide d'un crédit, le contrat de vente ou de
                                prestation de services le précise, quelle que soit l'identité
                                du prêteur. »

                                <p><b>Article L. 312-46 du Code de la consommation :</b></p>
                                « Aucun engagement ne peut valablement être contracté
                                par l'acheteur à l'égard du vendeur tant qu'il n'a pas
                                accepté le contrat de crédit. Lorsque cette condition n'est
                                pas remplie, le vendeur ne peut recevoir aucun paiement,
                                sous quelque forme que ce soit, ni aucun dépôt. »

                                <p><b>Article L. 312-47 du Code de la consommation :</b></p>
                                « Tant que le prêteur ne l'a pas avisé de l'octroi du crédit,
                                et tant que l'emprunteur peut exercer sa faculté de
                                rétractation, le vendeur n'est pas tenu d'accomplir son
                                obligation de livraison ou de fourniture. Toutefois, lorsque
                                par une demande expresse rédigée, datée et signée de sa
                                main même, l'acheteur sollicite la livraison ou la fourniture
                                immédiate du bien ou de la prestation de services, le délai
                                de rétractation ouvert à l'emprunteur par l'article L. 312-19
                                expire à la date de la livraison ou de la fourniture, sans
                                pouvoir ni excéder quatorze jours ni être inférieur à trois
                                jours. Toute livraison ou fourniture anticipée est à la
                                charge du vendeur qui en supporte tous les frais et
                                risques. »

                                <p><b>Article L. 312-48 du Code de la consommation :</b></p>
                                « Les obligations de l'emprunteur ne prennent effet qu'à
                                compter de la livraison du bien ou de la fourniture de la
                                prestation. En cas de contrat de vente ou de prestation de
                                services à exécution successive, les obligations prennent
                                effet à compter du début de la livraison ou de la fourniture
                                et cessent en cas d'interruption de celle-ci ».

                                <p><b>Article L. 312-49 du Code de la consommation :</b></p>
                                « Le vendeur ou le prestataire de services conserve une
                                copie du contrat de crédit et la présente sur leur demande
                                aux agents chargés du contrôle. »

                                <p><b>Article L. 312-50 du Code de la consommation :</b></p>
                                « Le vendeur ou le prestataire de services ne peut
                                recevoir, de la part de l'acheteur, aucun paiement sous
                                quelque forme que ce soit, ni aucun dépôt, en sus de la
                                partie du prix que l'acheteur a accepté de payer au
                                comptant, tant que le contrat relatif à l'opération de crédit
                                n'est pas définitivement conclu. Si une autorisation de
                                prélèvement sur compte bancaire est signée par
                                l'acquéreur, sa validité et sa prise d'effet sont
                                subordonnées à celles du contrat de vente. En cas de
                                paiement d'une partie du prix au comptant, le vendeur ou
                                prestataire de services doit remettre à l'acheteur un
                                récépissé valant reçu et comportant la reproduction
                                intégrale des dispositions des articles L. 312-52, L. 312-
                                53 et L. 341-10 ».

                                <p><b>Article L. 312.51 du Code de la consommation :</b></p>
                                « En cas de vente ou de démarchage à domicile, le délai
                                de rétractation est de quatorze jours quelle que soit la date
                                de livraison ou de fourniture du bien ou de la prestation de
                                services. Aucun paiement comptant ne peut intervenir
                                avant l'expiration de ce délai. »

                              </td>
                            </tr>
                          </table>
                          <footer class="footerAllPage">
                            <div class="cpiEcritureDixHuit" style="">
                              <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                                Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                              </div>
                              {if $company.picture.url}
                              <div class="imgFooter">


                                {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                              </div>
                              {/if}
                            </div>
                            <div class="numberOfPage" style="margin-top:-40px;">Page 1 / 3</div>

                          </footer>
                        </div>





                        <div class="pageSuivante cadreCondition" >
                          <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>
                          {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                                          <td style="tableDevis">{$quotation.reference}</td>

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
                          <table style="margin-top: -10px;width:1450px;margin-right:auto;margin-left:auto;">
                            <tr>
                              <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                <p><b>Article L. 312-52 du Code de la consommation :</b></p>
                                « Le contrat de vente ou de prestation de services est
                                résolu de plein droit, sans indemnité :
                                1° Si le prêteur n'a pas, dans un délai de sept jours à
                                compter de l'acceptation du contrat de crédit par
                                l'emprunteur, informé le vendeur de l'attribution du crédit ;
                                2° Ou si l'emprunteur a exercé son droit de rétractation
                                dans le délai prévu à l'article L. 312-19.
                                Toutefois, lorsque l'emprunteur, par une demande
                                expresse, sollicite la livraison ou la fourniture immédiate
                                du bien ou de la prestation de services, l'exercice du droit
                                de rétractation du contrat de crédit n'emporte résolution de
                                plein droit du contrat de vente ou de prestation de services
                                que s'il intervient dans un délai de trois jours à compter de
                                l'acceptation du contrat de crédit par l'emprunteur.
                                Le contrat n'est pas résolu si, avant l'expiration des délais
                                mentionnés au présent article, l'acquéreur paie
                                comptant ».

                                <p><b>Article L. 312-53 du Code de la consommation :</b></p>
                                « Dans les cas de résolution du contrat de vente ou de
                                prestations de services prévus à l'article L. 312-52, le
                                vendeur ou le prestataire de services rembourse, sur
                                simple demande, toute somme que l'acheteur aurait
                                versée d'avance sur le prix ».

                                <p><b>Article L. 312-54 du Code de la consommation :</b></p>
                                « Lorsque le consommateur exerce son droit de
                                rétractation du contrat de vente ou de fourniture de

                                prestation de services mentionné au 9° de l'article L. 311-
                                1, le contrat de crédit destiné à en assurer le financement
                                est résilié de plein droit sans frais ni indemnité, à
                                l'exception éventuellement des frais engagés pour
                                l'ouverture du dossier de crédit. »

                                <p><b>Article L. 312-55 du Code de la consommation :</b></p>
                                « En cas de contestation sur l'exécution du contrat
                                principal, le tribunal peut, jusqu'à la solution du litige,
                                suspendre l'exécution du contrat de crédit. Celui-ci est
                                résolu ou annulé de plein droit lorsque le contrat en vue
                                duquel il a été conclu est lui-même judiciairement résolu
                                ou annulé.
                                Les dispositions du premier alinéa ne sont applicables que
                                si le prêteur est intervenu à l'instance ou s'il a été mis en
                                cause par le vendeur ou l'emprunteur. »

                                <p><b>Article L. 312-56 du Code de la consommation :</b></p>
                                « Si la résolution judiciaire ou l'annulation du contrat
                                principal survient du fait du vendeur, celui-ci peut, à la
                                demande du prêteur, être condamné à garantir
                                l'emprunteur du remboursement du prêt, sans préjudice
                                de dommages et intérêts vis-à-vis du prêteur et de
                                l'emprunteur. »

                                <p><b><u>7.3- Paiement comptant des pièces de rechange et/ou
                                  accessoires</u></b></p>
                                  Sauf dispositions contraires prévues au devis, le prix des
                                  pièces de rechange et/ou accessoires devra être réglé au
                                  comptant en totalité.
                                  Tout retard de paiement entraine automatiquement
                                  l’application de pénalités. Les pénalités sont calculées sur
                                  la base du montant de la facture TTC du Client au taux
                                  légal en vigueur multiplié par trois. Les pénalités sont
                                  encourues à partir du jour suivant l’échéance de la facture
                                  et jusqu'au jour de son règlement total.

                                  <p><b>8- DROIT DE RETRACTATION</b></p>
                                  Conformément à l'article L. 221-18 du Code de la
                                  consommation, le Client dispose d'un délai de quatorze
                                  jours pour exercer son droit de rétractation. Ce délai court
                                  à compter du jour de la réception des Equipement(s) ainsi
                                </td>

                                <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                  que pour les contrats de vente de produit accompagnés
                                  d’une prestation de services (notamment prestation de
                                  montage et d'installation). Si le contrat porte uniquement
                                  sur des Prestations de services, ce délai court à compter
                                  du jour de la conclusion du contrat. Ainsi si le Client
                                  demande l’installation des Equipements le jour de sa
                                  livraison ou à toute autre date intervenant avant
                                  l’expiration du délai de rétractation, il renonce à son droit
                                  de rétractation sur cette prestation de service d’installation
                                  (mais le conserve sur l'Equipement lui-même dans le délai
                                  de quatorze jours à compter de sa livraison). Le Client
                                  pourra exercer son droit de rétractation en adressant à la
                                  Société par lettre recommandée avec accusé de réception
                                  le formulaire de rétractation accompagnant le devis signé.
                                  Conformément à l'article L. 221-28 du Code de la
                                  consommation, le droit de rétractation ne peut être exercé
                                  d'une part, s'agissant de prestations de services
                                  pleinement exécutées avant la fin du délai de rétractation
                                  (prestations de montage et d'installation des
                                  Equipements) et dont l'exécution a commencé après
                                  accord préalable et exprès du client et renoncement
                                  exprès à son droit de rétractation et d'autre part, s'agissant
                                  de travaux d'entretien ou de réparation à réaliser en
                                  urgence au domicile du Client et expressément sollicités
                                  par lui, dans la limite des pièces de rechange et travaux
                                  strictement nécessaires pour répondre à l'urgence.
                                  Conformément à l'article L. 221-23 du Code de la
                                  consommation, si les Equipements ne peuvent pas être
                                  renvoyés normalement par voie postale compte tenu de
                                  leur nature, la Société récupèrera les Equipements à ses
                                  frais, hormis les frais de démontage associés qui resteront
                                  à la charge du Client. Si les Equipements peuvent être
                                  renvoyés par voie postale, ils seront renvoyés par le Client
                                  à la Société aux frais du Client au plus tard dans un délai
                                  de quatorze jours à compter de sa décision de se rétracter.
                                  La Société remboursera alors au Client la totalité des
                                  sommes versées par celui-ci au plus tard dans les
                                  quatorze jours à compter de la date à laquelle elle est
                                  informée de la décision du Client de se rétracter. Le
                                  remboursement pourra être différé jusqu'à la récupération
                                  des Equipements par la Société ou jusqu'à ce que le Client
                                  ait fourni une preuve d'expédition des Équipements,
                                  lorsque ces derniers sont renvoyés par le client.
                                  Conformément à l’article L.312-54 du Code de la
                                  consommation, dans le cas où le contrat est assorti d’un

                                  crédit affecté au sens de l'article L. 311-1 du Code de la
                                  consommation, l’exercice par le Client de son droit de
                                  rétractation du contrat entraine la résiliation de plein droit
                                  du contrat de crédit, sans frais ni indemnités, à l'exception
                                  éventuellement des frais engagés pour l'ouverture du
                                  dossier de crédit.

                                  <p><b>9- GARANTIES</b></p>
                                  En cas de défaut ou panne, le Client devra contacter la
                                  Société au numéro de téléphone indiqué sur le devis
                                  accepté par le Client. La Société confirmera au Client la
                                  marche à suivre pour mettre en œuvre la garantie.

                                  <p><b><u>9.1 Garanties légales:</u></b></p>
                                  La Société est tenue, pour tous les Equipements vendus,
                                  à l'application des garanties légales de conformité (articles
                                  L. 217-4 à L. 217-15 et L. 217-16 du Code de la
                                  consommation) et des vices cachés (articles 1641 à 1649
                                  du Code civil) dans les conditions prévues par la loi.
                                  La Société informe le Client que, lorsque celui-ci
                                  agit en <b>garantie légale de conformité</b> :
                                  - il bénéficie d’un délai de deux ans à compter de
                                  la délivrance du/des Équipements pour agir ;
                                  - il peut choisir entre la réparation ou le
                                  remplacement du/des Équipements, sous réserve
                                  des conditions de coût prévues par l’article L. 217-
                                </td>


                                <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                  9 du Code de la consommation ;<br>
                                  - il est dispensé de rapporter la preuve de
                                  l’existence du défaut de conformité du/des
                                  Équipements durant les 24 mois suivants la
                                  délivrance du/des Équipements.
                                  La garantie légale de conformité s’applique
                                  indépendamment de la garantie commerciale
                                  consentie par la Société.
                                  Il est rappelé que le Client peut également décider
                                  de mettre en œuvre <b>la garantie contre les
                                    défauts cachés de la chose vendue</b> au sens de
                                    l’article 1641 du Code civil et que dans cette
                                    hypothèse il peut choisir entre la résolution de la
                                    vente ou une réduction de prix conformément à
                                    l’article 1644 du code civil.
                                    La Société décline en revanche toute responsabilité ou
                                    garantie dans le cas d’une mauvaise utilisation de
                                    l'Equipement, dans le cas d’une utilisation détournée par
                                    le Client et/ou dans le cas de l'usure normale des
                                    Équipements.
                                    Si les Équipements livrés sont non conformes aux
                                    Équipements commandés par le Client ou s’ils présentent
                                    des vices-cachés, ce dernier devra adresser un courrier
                                    recommandé avec accusé de réception à la Société à
                                    l’adresse indiquée sur le devis accepté par le Client, pour
                                    lui notifier la non-conformité ou les vices-cachés des
                                    Equipements dans les plus brefs délais. La Société
                                    accusera réception de la demande du Client et lui
                                    confirmera la marche à suivre si le caractère non
                                    conforme des Equipements est confirmé.

                                    <p><b><u>Rappel des textes légaux sur les garanties légales</u></b></p>
                                    <p><b>Article L. 217-4 du Code de la consommation :</b></p>
                                    « Le vendeur livre un bien conforme au contrat et répond
                                    des défauts de conformité existant lors de la délivrance.
                                    Il répond également des défauts de conformité résultant
                                    de l'emballage, des instructions de montage ou de
                                    l'installation lorsque celle-ci a été mise à sa charge par le
                                    contrat ou a été réalisée sous sa responsabilité. »

                                    <p><b>Article L. 217-4 du Code de la consommation :</b></p>
                                    « Le bien est conforme au contrat :
                                    1° S’il est propre à l'usage habituellement attendu d'un
                                    bien semblable et, le cas échéant :
                                    - s’il correspond à la description donnée par le vendeur et
                                    possède les qualités que celui-ci a présentées à l'acheteur
                                    sous forme d'échantillon ou de modèle ;
                                    - s’il présente les qualités qu'un acheteur peut
                                    légitimement attendre eu égard aux déclarations
                                    publiques faites par le vendeur, par le producteur ou par
                                    son représentant, notamment dans la publicité ou
                                    l'étiquetage ;
                                    2° Ou s’il présente les caractéristiques définies d'un
                                    commun accord par les parties ou est propre à tout usage
                                    spécial recherché par l'acheteur, porté à la connaissance
                                    du vendeur et que ce dernier a accepté. »

                                    <p><b>Article L. 217-12 du Code de la consommation :</b></p>
                                    « L'action résultant du défaut de conformité se prescrit par
                                    deux ans à compter de la délivrance du bien. »

                                    <p><b>Article L. 217-16 du Code de la consommation :</b></p>
                                    « Lorsque l'acheteur demande au vendeur, pendant le
                                    cours de la garantie commerciale qui lui a été consentie
                                    lors de l'acquisition ou de la réparation d'un bien meuble,
                                    une remise en état couverte par la garantie, toute période
                                    d'immobilisation d'au moins sept jours vient s'ajouter à la
                                    durée de la garantie qui restait à courir.
                                    Cette période court à compter de la demande
                                    d'intervention de l'acheteur ou de la mise à disposition
                                    pour réparation du bien en cause, si cette mise à
                                    disposition est postérieure à la demande d'intervention. »
                                  </td>
                                </tr>
                              </table>
                              <footer class="footerAllPage">
                                <div class="cpiEcritureDixHuit" style="">
                                  <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                                    Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                                  </div>
                                  {if $company.picture.url}
                                  <div class="imgFooter">


                                    {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                                  </div>
                                  {/if}
                                </div>
                                <div class="numberOfPage" style="margin-top:-40px;">Page 2 / 3</div>

                              </footer>
                            </div>






                            <div class="pageSuivante cadreCondition"  style="color: #000;">
                              <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>
                              {if $company.picture}  <img class="logo"style="" src="{$company.picture.url}" />{/if}
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
                                              <td style="tableDevis">{$quotation.reference}</td>

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
                              <table style="margin-top: -10px;width:1450px;margin-right:auto;margin-left:auto;">
                                <tr>
                                  <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                    <p><b>Article 1641 du Code civil :</b></p>
                                    « Le vendeur est tenu de la garantie à raison des défauts
                                    cachés de la chose vendue qui la rendent impropre à
                                    l'usage auquel on la destine, ou qui diminuent tellement
                                    cet usage, que l'acheteur ne l'aurait pas acquise, ou n'en
                                    aurait donné qu'un moindre prix, s'il les avait connus. »
                                    Article 1648 du Code civil, premier alinéa :
                                    « L'action résultant des vices rédhibitoires doit être
                                    intentée par l'acquéreur dans un délai de deux ans à
                                    compter de la découverte du vice. »

                                    <p><b><u>9.2. Disponibilité des pièces détachées</u></b></p>
                                    Les pièces détachées indispensables à l'utilisation des
                                    Equipements commercialisés par la Société sont
                                    disponibles pendant la durée indiquée sur le devis.

                                    <p><b><u>10 – RESERVE DE PROPRIETE</u></b></p>
                                    La Société conserve la pleine propriété des Equipements
                                    achetés par le Client jusqu'à ce que ce dernier ait rempli
                                    l'intégralité de ses obligations et notamment jusqu'au
                                    parfait paiement du prix convenu dans sa totalité. En cas
                                    de défaut de paiement, la Société est en droit de
                                    revendiquer la restitution des marchandises par toute voie
                                    de droit.

                                    <p><b>11- FICHIER ELECTRONIQUE ET PROTECTION DE LA
                                      VIE PRIVEE</b></p>

                                      <p><b><u>11.1 – Finalité et qualité de responsable de traitement</u></b></p>
                                      Dans le cadre de son activité, la Société, agissant en
                                      qualité de responsable de traitement, procède à un
                                      traitement informatisé des données de ses Clients et
                                      prospects dans le respect de la réglementation en vigueur
                                      relative à la protection des données personnelles.
                                      La Société veille à ne collecter et ne traiter que des
                                      données strictement nécessaires au regard de la finalité
                                      pour laquelle elles sont traitées.
                                      L’utilisation des données collectées est strictement
                                      nécessaire à l’exécution du Contrat ou relève de l’intérêt
                                      légitime de la Société.
                                      La collecte et le traitement de ces données est nécessaire
                                      pour la création du compte Client, à la programmation des
                                      interventions de la Société, à la gestion des commandes,
                                      à la gestion des avis des personnes sur des produits,
                                      services ou contenus, au traitement des réclamations, à la
                                      facturation et aux opérations de recouvrement.
                                      Le nom, le prénom, l’adresse et les caractéristiques du
                                      logement, le numéro de téléphone et l’adresse mail du
                                      Client, et le cas échéant, les coordonnées de l’Utilisateur
                                      si celui-ci est différent du Client, ou du Propriétaire si le
                                      Client est locataire, ainsi que l’ancienneté du logement
                                      sont essentiels à l’exécution du Contrat.
                                      Elles sont collectées directement auprès du Client lors de
                                      la signature du Contrat. En cas de refus du Client de
                                      communiquer ses données personnelles, la Société ne
                                      sera pas en mesure de conclure le contrat de service
                                      demandé.
                                      La Société s’efforce, par ailleurs, de personnaliser ses
                                      services afin de répondre au mieux aux attentes de ses
                                      clients.
                                      Dans ce cadre, la Société est amenée à collecter
                                      directement ou indirectement, avec le consentement de la
                                      personne concernée, des données non strictement
                                      nécessaires à l’exécution du Contrat, afin de mieux
                                      connaître ses clients et de pouvoir proposer les offres les
                                      plus pertinentes. Le Client peut autoriser la Société à
                                      traiter ses données à des fins de prospection commerciale
                                      au moment de la Collecte de ses données.
                                      La Société est également susceptible d’utiliser les
                                      données de navigation de ses Clients et prospects
                                      collectées sur les sites internet de la Société ou de ses
                                      partenaires et de les associer avec d’autres données. À

                                    </td>
                                    <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                      tout moment, le Client a la possibilité de s’opposer au
                                      dépôt de cookies sur son terminal en désactivant les
                                      cookies éventuellement déjà déposés.

                                      S’il l’accepte, le Client peut également faire l’objet de
                                      profilage à des fins publicitaires. À tout moment, il pourra
                                      ensuite s’y opposer en exerçant son droit d’opposition à
                                      l’adresse mentionnée ci-après et, la Société ne sera alors
                                      plus en mesure de proposer des services personnalisés
                                      ou des offres promotionnelles ciblées au Client.

                                      <p><b><u>11.2 Durée de Conservation</u></b></p>
                                      Les données personnelles sont conservées pour la durée
                                      nécessaire à l’accomplissement des finalités mentionnées
                                      ci-dessus et eu égard à la prescription en vigueur et aux
                                      obligations légales de conservation de certains
                                      contrats/données.
                                      En particulier (et sous réserve d’une modification
                                      ultérieure des délais de prescription et/ou des obligations
                                      légales de conservation spécifiques)
                                      - S’agissant des traitements relatifs à l’exécution du
                                      Contrat, les données personnelles du Client sont
                                      conservées pour une durée de dix ans à compter de la
                                      livraison du bien ou de la fin de l’exécution de la dernière
                                      prestation contractuelle (en archivage, conformément aux
                                      obligations légales de conservation des contrats conclus
                                      par voie électronique et des documents comptables).
                                      - les données des clients utilisées à des fins de
                                      prospection commerciale peuvent être conservées
                                      pendant un délai de trois ans à compter de la fin de la
                                      relation commerciale (par exemple, à compter d'un achat,
                                      de la date d'expiration d'une garantie, du terme d'un
                                      contrat de prestations de services ou du dernier contact
                                      émanant du client).
                                      - Les données personnelles relatives à un prospect non
                                      client sont conservées pendant un délai de trois ans à
                                      compter de leur collecte ou du dernier contact émanant du
                                      prospect - par exemple, une demande de documentation
                                      ou un clic sur un lien hypertexte contenu dans un courriel.

                                      <p><b><u>11.3 Destinataires ou catégories de destinataires des
                                        données</u></b></p>
                                        Les données traitées sont destinées aux services internes
                                        de la Société. Elles peuvent être transmises aux Sociétés
                                        du Groupe {$company.name} . Pour l’exécution de ses obligations, la
                                        Société peut faire appel à des prestataires ou des soustraitants ou partenaires, à des établissements financiers et
                                        postaux, à des tiers autorisés en vertu d’une disposition
                                        légale ou réglementaire. La Société s’engage à ne
                                        transmettre les données personnelles des Clients
                                        qu’après vérification de la conformité aux dispositions
                                        réglementaires relatives à la protection des données
                                        personnelles, du traitement des données transférées par
                                        le destinataire.

                                        Par ailleurs, dans le cas où la Société ou une part de ses
                                        actifs seraient transmis à un tiers, notamment par
                                        succession, vente, fusion, transformation du fonds, les
                                        données personnelles des Clients seront transmis audit
                                        tiers.

                                        <p><b><u>11.4 Transfert hors UE</u></b></p>
                                        Certaines données peuvent faire l’objet d’un traitement
                                        ponctuel par certains prestataires situés en dehors de
                                        l’Union Européenne si le traitement est nécessaire à
                                        l’exécution du Contrat. Le cas échéant, le transfert ne
                                        s’effectuera qu’auprès d’une société du Groupe {$company.name}  en
                                        vertu d’un accord de transferts intra-groupe de données
                                        personnelles, ou d’une société prestataire, établit dans un
                                        pays justifiant d’un niveau de protection adéquat des
                                        données personnelles au terme de la « Décision
                                        d’adéquation » officielle de la Commission Européenne. A
                                        défaut, la Société s’engage à recueillir le consentement

                                      </td>

                                      <td style="width:220px;font-familly:'Arial';font-size:16px;vertical-align:top;text-align:justify;padding:7px;color: #000;">
                                        exprès et écrit du Client avant de transférer ses données
                                        et s’engage à lui apporter la meilleure information sur les
                                        risques liés.

                                        <p><b><u>11.5 Sécurité des données</u></b></p>
                                        La Société prend toutes les mesures physiques,
                                        techniques et organisationnelles appropriées et
                                        nécessaires pour garantir la sécurité des données
                                        stockées, notamment pour empêcher que des tiers non
                                        autorisés puissent y accéder.

                                        <p><b><u>11.6 Droits des personnes et coordonnées DPO</u></b></p>
                                        Le Client dispose d’un droit d’accès, de rectification,
                                        d’information complémentaire, d’opposition, de portabilité,
                                        d’effacement et de limitation, dans les conditions prévues
                                        par la règlementation, auprès du délégué à la protection
                                        des données (DPO) de la Société et pourra le contacter à
                                        l’adresse suivante : {$company.name} - {$company.address1}, {$company.postcode} {$company.city}
                                        CEDEX ou par courrier électronique à : <u>donnees-<br>{$company.email}</u>.

                                        <p><b><u>11.7 Droit d’introduire une réclamation auprès d’une
                                          autorité de contrôle</u></b></p>
                                          Le Client est informé qu’il dispose également de la
                                          possibilité d’introduire une réclamation auprès de la CNIL.

                                          <p><b><u>11.8 Prospection commerciale par téléphone</u></b></p>
                                          Conformément à l’article L.223-1 du Code de la
                                          consommation, le Client à la possibilité de s’inscrire sur la
                                          liste d’opposition au démarchage téléphonique BLOCTEL.

                                          <p><b>12- FORCE MAJEURE</b></p>
                                          L’exécution par la Société de tout ou partie de ses
                                          obligations sera suspendue en cas de survenance d’un
                                          cas de force majeure qui en gênerait ou en retarderait
                                          l’exécution au sens qu’en donne l’article 1218 du Code
                                          civil. La Société informera le Client d’un semblable cas de
                                          force majeure dans les sept jours de sa survenance. Au
                                          cas où cette suspension se poursuivrait au-delà d’un délai
                                          de quinze jours, le Client ou la Société auront alors la
                                          possibilité de résilier la commande en cours, et il serait
                                          alors procédé à son remboursement selon le procédé
                                          énoncé à l’article 8 « droit de rétractation ».

                                          <p><b>15- DROIT APPLICABLE, MEDIATION ET
                                            JURIDICTION COMPETENTE</b></p>
                                            Les présentes conditions générales de vente, et plus
                                            généralement le contrat conclu avec la Société, sont
                                            exclusivement soumis au droit français.
                                            En cas de litige relatif à leur interprétation et/ou à leur
                                            exécution, le Client est tenu d'adresser ses réclamations
                                            par écrit au Service Consommateur de la Société à
                                            l'adresse suivante :
                                            {$company.name} - {$company.address1}, {$company.postcode} {$company.city} Ou en renseignant
                                            un formulaire en ligne sur la page 'Nous Alerter' du site
                                            {$company.web}.
                                            A défaut de résolution amiable du litige avec la Société
                                            dans un délai de quatre-vingt-dix (90) jours à compter de
                                            la date de réception par la Société de la réclamation écrite,
                                            le Client peut saisir le médiateur {$company.firstname1} {$company.lastname1} :{$company.function1}
                                            - par courrier à l'adresse suivante : {$company.name} - {$company.address1}, {$company.postcode} {$company.city} ;
                                            - ou par Internet via le formulaire disponible sur le site
                                            Internet {$company.web}
                                            Le Médiateur {$company.name} tentera, en toute indépendance et
                                            impartialité, de rapprocher les parties en vue d'aboutir à
                                            une solution amiable, conformément aux articles L. 611-1
                                            et suivants du Code de la consommation. Le Client reste
                                            libre d’initier, d'accepter ou de refuser le recours à la
                                            médiation. En cas de recours à la médiation, les parties
                                            restent libres d'accepter ou de refuser la solution proposée
                                            par le Médiateur.
                                            En cas d'échec de la médiation ou de tout autre mode de
                                            résolution extrajudiciaire, tout litige sera soumis à la
                                            compétence exclusive des tribunaux français compétents.

                                          </td>
                                        </tr>
                                      </table>
                                      <footer class="footerAllPage">
                                        <div class="cpiEcritureDixHuit" style="">
                                          <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                                            Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                                          </div>
                                          {if $company.picture.url}
                                          <div class="imgFooter">


                                            {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                                          </div>
                                          {/if}
                                        </div>
                                        <div class="numberOfPage" style="margin-top:-40px;">Page 3 / 3</div>

                                      </footer>
                                    </div>

                                    <div class="pageSuivante cadreCondition"  style="color: #000;">
                                      <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>
                                      {if $polluter.picture != null}<div style="display:inline;width:100%;position:absolute;left: 4px;">
                                        <img   class="logo" style="width:150px;margin-left:20px;margin-top:8px;"   src="{$polluter.picture.url}" /></div>{/if}
                                        <div style=";width: 510px;height:200px;left: 120px;text-align: center;padding: 3px;margin-right:auto;margin-left:auto;">
                                          <h1>FORMULAIRE DE RÉTRACTATION</h1>
                                          <b><p>Code de la consommation, Articles L.221-18 à L.221-28 et Décret n° 2014/1061 du 17 septembre 2014
                                            et Annexe à l’article R221-1 créé par Décret n°2016-884 du 29 juin 2016</p></b>
                                          </div>
                                          <div style="margin-top: 160px;margin-left: 55px;">
                                            <p class="retractationSize">Complétez et renvoyez le présent formulaire uniquement si vous souhaitez vous rétracter du contrat
                                              souscrit.</p>

                                              <p class="retractationSize">Expédiez ce formulaire au plus tard le quatorzième jour à partir de la réception des équipements pour les contrats de vente d’équipement,
                                                ainsi que pour les contrats de vente d’équipement accompagnés d’une prestation de services (notamment prestation de montage et
                                                d’installation). Si ce délai expire normalement un samedi, un dimanche ou jour férié ou chômé, il est prorogé jusqu’au premier jour ouvrable
                                                suivant.</p>
                                                <br><br>
                                                <p class="retractationSize">À adresser par lettre recommandée avec avis de réception à l’adresse de l’agence figurant sur ce devis</p>
                                                <p class="retractationSize">Je vous notifie par la présente ma rétractation du devis portant sur la vente d’équipement accompagnée d’une
                                                  prestation de services (notamment prestation de montage et d’installation) ci-dessous :</p>
                                                  <p>___________________________________________________________________________________________________</p>
                                                  <p class="retractationSize">Commandé le : _____ /___________ / 20_____</p><br>
                                                  <div class="retractationSize">Nom du consommateur :<br>
                                                    ____________________________________________________________________________</div><br>
                                                    <div class="retractationSize">Adresse :<br>
                                                      ________________________________________________________________________________________</div>
                                                      <p>___________________________________________________________________________________________________</p>
                                                      <div style="position:;right:5px;" class="retractationSize">
                                                        Date : _______ /__________ / 20_____
                                                        <br><br><br><br>
                                                        Signature du consommateur :
                                                      </div>
                                                    </div>
                                                    <footer class="footerAllPage">
                                                      <div class="cpiEcritureDixHuit" style="">
                                                        <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                                                          Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                                                        </div>
                                                        {if $company.picture.url}
                                                        <div class="imgFooter">


                                                          {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                                                        </div>
                                                        {/if}
                                                      </div>
                                                      <div class="numberOfPage" style="margin-top:-40px;">Page 1 / 1</div>

                                                    </footer>
                                                  </div>

                                                  <div class="cadreCondition"  style="color: #000;">
                                                    <div style="width: 100px;height: 95px;background: #b4d863;;margin-left:1500px;border-radius: 0% 0% 0% 100%;"></div>
                                                    <div style="margin-top: 80px;margin-left: -20px;">
                                                      <h1 style="text-align: center;">RENONCIATION AU DROIT DE RÉTRACTATION</h1>
                                                      <br><br>
                                                      <div style="margin: 0 55px;">
                                                        <p class="retractationSize">Je soussigné(e)   {$customer.lastname}  {$customer.firstname}
                                                        </p>
                                                        <p class="retractationSize">déclare souhaiter expressément que les prestations de services de réparation ou d’entretien et
                                                          les ventes d’équipements associées visées par le contrat soient exécutées par{$company.name}  avant la fin du délai de rétractation. Je renonce ainsi à mon droit de rétractation
                                                          s’agissant des prestations de services exécutées avant la fin du délai de rétractation. Je
                                                          m’engage donc à régler à {$company.name}  le montant des prestations exécutées.</p>
                                                          <div style="border: 1px solid #000;border-radius: 5px;padding: 8px ;width: 700px;margin:auto;">
                                                            <p class="retractationSize">Contrat concerné par la renonciation au droit de rétractation :</p>
                                                            <p class="retractationSize">Devis n° <span style="color:#000;">{$quotation.reference} du  {$contract.quoted_at.ddmmyyyy}
                                                            </span> </p>
                                                            <p class="retractationSize">ou Contrat d’entretien formule .................................. conclu le .. / .. / ....</p>
                                                          </div>
                                                          <p class="retractationSize">Nom du client :<span style="color:#000;">
                                                            {$customer.gender} {$customer.lastname|upper} {$customer.firstname|upper} </span> </p><br>
                                                            <div class="retractationSize">Adresse du client :<span style="color:#000;">{$customer.address.address1|upper} , </span>
                                                            </div>
                                                            <div><span style="color:#000;" class="retractationSize">{$customer.address.city|upper} - {$customer.address.postcode|upper}</span></div>
                                                            <div>...............</div><br>
                                                            <p class="retractationSize">Date :<span style="color:#000;"> {$contract.quoted_at.ddmmyyyy}
                                                            </span></p>
                                                            <div class="retractationSize" style="left:500px;" >
                                                              Signature du client :
                                                              <div>
                                                                <signature style="width:430px;height:10%;font-size:20px;margin:auto;margin-top:5px;text-align:center;margin-left: 20px;" name="signature"> </signature>
                                                              </div>
                                                            </div>
                                                            <br><br><br>
                                                            <p style="margin-top: 90px;" class="retractationSize">À RETOURNER À {$company.name} </p>
                                                            <div class="retractationSize" style="text-align: right;">
                                                              Pour en savoir plus :<br>
                                                              <b>{$company.web} </b>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <footer class="footerAllPage">
                                                          <div class="cpiEcritureDixHuit" style="">
                                                            <div class="" style="" ><b>  {$company.name}</b> <br> {$company.address1}, {$company.postcode} {$company.city}<br>
                                                              Tél: {$company.phone} - Mail: {$company.email}<br>APE : {$company.ape} - au capital de : {$company.capital} {eval $company.comments}
                                                            </div>
                                                            {if $company.picture.url}
                                                            <div class="imgFooter">


                                                              {*<img style="width:90px;margin-left:1450px;" src="{$company.picture.url}" />*}
                                                            </div>
                                                            {/if}
                                                          </div>
                                                          <div class="numberOfPage" id="testtPage" style="margin-top:-40px;">Page 1 / 1</div>

                                                        </footer>
                                                      </div>

                                                     <script>
                                                  /*  var pages = document.getElementsByClassName("Pager");
                                                //    console.log(pages.length);
                                                    for (var i = 0; i < pages.length; i++) {

                                                      pages[i].innerHTML+=(i+1)+"/"+pages.length;
                                                    }*/

                                                </script>

                                             </body>
                                             </html>
