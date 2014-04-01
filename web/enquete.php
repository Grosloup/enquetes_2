<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/03/2014
 */

include_once "../datas/depts.php";
include_once "../datas/pays.php";
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title></title>

    <!-- <link rel="stylesheet" href="/web/css/master.css"/>
    <link rel="stylesheet" href="/web/css/font-awesome.min.css"/> -->
    <link rel="stylesheet" href="/css/master.css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css"/>

    <script src="js/vendor/modernizr.js"></script>

</head>
<body>
<!-- if html.lt-ie9 -->
<div class="browserhappy">
    <p>Vous utilisez une version d'internet explorer incompatible avec ce site. Mettez à jour internet explorer vers la version 11, ou utilisez des navigateurs tels que
        <a href="https://www.google.com/intl/fr/chrome/browser/">Google Chrome</a>, <a href="http://www.mozilla.org/en-US/firefox/all/">Firefox</a>,...</p>
</div>

<div id="sidebar" class="">
    <div id="sb-actions">
        <button class="toggler"><span></span></button>
    </div>
    <div id="sb-inner">
        <ul>
            <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a></li>
        </ul>
        <ul>
            <li><a href="#question-1" class="goto-question current">Q1. Quelle était la date de votre visite au ZooParc de Beauval ? - SAISIR AU FORMAT JJ/MM</a></li>
            <li><a href="#question-2" class="goto-question">Q2. Quel est le numéro de votre département d'habitation ? (100 pour Pays étranger)</a></li>
            <li><a href="#question-3" class="goto-question">Q3. Combien de temps avez-vous passé au ZooParc ?</a></li>
            <li><a href="#question-4" class="goto-question">Q4a. Quel est le contexte de votre visite  :</a></li>
            <li><a href="#question-5" class="goto-question">Q4b et Q4c. Combien de temps dure votre séjour (si vous n'habitez pas ici) ?</a></li>
            <li><a href="#question-6" class="goto-question">Q5. Combien de temps a duré votre trajet jusqu'à Beauval ?</a></li>
            <li><a href="#question-7" class="goto-question">Q6a et Q6b et Q6c. Personnellement, étiez vous déjà venu au ZooParc de Beauval ?</a></li>
            <li><a href="#question-8" class="goto-question">Q7a et Q7b. Concernant votre visite d'aujourd'hui, vous êtes-vous décidé au dernier moment ou l'aviez-vous programmée à l'avance ?</a></li>
            <li><a href="#question-9" class="goto-question">Q8a et Q8b. Saviez-vous avant de venir que le ZooParc de Beauval avait accueilli 2 pandas géants ?</a></li>
            <li><a href="#question-10" class="goto-question">Q9. Quels sont tous les moyens qui vous ont permis d'entendre parler du ZooParc de Beauval et vous ont décidé à venir ?</a></li>
            <li><a href="#question-11" class="goto-question">Q10. Avant de venir au ZooParc de Beauval:</a></li>
            <li><a href="#question-12" class="goto-question">Q11. Globalement, en ce qui concerne la visite du ZooParc de Beauval, diriez-vous que vous avez :</a></li>
            <li><a href="#question-13" class="goto-question">Q12a Q12b Q12c. Vous êtes-vous arrêté dans un point de restauration ?</a></li>
            <li><a href="#question-14" class="goto-question">Q13. Remarques et suggestions</a></li>
            <li><a href="#question-15" class="goto-question">Q14a et Q14b. Aimeriez-vous recevoire 2 ou 3 fois par an des informations sur le ZooParc de Beauval (nouveautés, offres promotionnelles...) ?</a></li>
            <li><a href="#question-16" class="goto-question">Civilités</a></li>
            <li><a href="#question-17" class="goto-question">Validation</a></li>
        </ul>

    </div>
</div>
<div id="main-enquete">
    <form action="/web/process.php" method="post" id="theForm">



    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q1          ######################################################## -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-1">
            <div class="wrapper">
                <div class="question">
                    <h1>Q1. Quelle était la date de votre visite au ZooParc de Beauval ? - SAISIR AU FORMAT JJ/MM</h1>
                    <div class="row">
                        <div class="col col2"></div>
                        <div class="col col2">
                            <div class="field">
                                <label for="q_1">Entrez une date, champs obligatoire</label>
                                <input type="text" placeholder="JJ/MM" name="form[q_1]" maxlength="5" id="q_1" style="width: 6em;"/>
                            </div>
                            <div class="field">
                                <label for="q_1_1">Modifiez l'année si besoin</label>
                                20<input type="text" placeholder="AA" name="form[q_1_1]" maxlength="2" id="q_1_1" style="width: 3em;"/>
                            </div>
                        </div>
                        <div class="col col2"></div>

                    </div>
                </div>
            </div>

        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q2          ######################################################## -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-2">
            <div class="wrapper">
                <div class="question">
                    <h1>Q2. Quel est le numéro de votre département d'habitation ? (100 pour Pays étranger)</h1>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col3">
                            <div class="field">
                                <select name="form[q_2]" id="q_2">
                                    <option value="">choisir dans  la liste</option>
                                    <?php foreach($departements as $num=>$nom): ?>
                                        <option value="<?php echo $num." - ".$nom; ?>"><?php echo $num." - ".$nom; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col2"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col3">
                            <h4>Si étranger précisez</h4>
                            <div class="field">
                                <select name="form[q_2_1]" id="q_2_1">
                                    <option value="">choisir dans  la liste</option>
                                    <?php foreach($pays as $num=>$nom): ?>
                                        <option value="<?php echo $nom; ?>"><?php echo $nom; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col2"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q3          ######################################################## -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-3">
            <div class="wrapper">
                <div class="question">
                    <h1>Q3. Combien de temps avez-vous passé au ZooParc ?</h1>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col3">
                            <div class="field">
                                <label for="q_3_a"><input type="radio" name="form[q_3]" id="q_3_a" value="1"/> 1 jour</label>
                            </div>
                            <div class="field">
                                <label for="q_3_b"><input type="radio" name="form[q_3]" id="q_3_b" value="2"/> 2 jours</label>
                            </div>
                        </div>
                        <div class="col col2"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q4a          ####################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-4">
            <div class="wrapper">
                <div class="question">
                    <h1>Q4a. Quel est le contexte de votre visite  :</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_4_1_a"><input type="radio" name="form[q_4_1]" id="q_4_1_a" value="1"/> Vous habitez près de Beauval, dans un rayon de 20 km</label>
                            </div>
                            <div class="field">
                                <label for="q_4_1_b"><input type="radio" name="form[q_4_1]" id="q_4_1_b" value="2"/> Vous êtes venu exprès à Beauval pour la journée ou le week-end</label>
                            </div>
                            <div class="field">
                                <label for="q_4_1_c"><input type="radio" name="form[q_4_1]" id="q_4_1_c" value="3"/> Vous étiez déjà près de Beauval de passage ou en vacances</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q4b Q4c          ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-5">
            <div class="wrapper">
                <div class="question">
                    <h1>Q4b et Q4c. Combien de temps dure votre séjour (si vous n'habitez pas ici) ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_4_2_a"><input type="radio" name="form[q_4_2]" id="q_4_2_a" value="1"/> 1 jour</label>
                            </div>
                            <div class="field">
                                <label for="q_4_2_b"><input type="radio" name="form[q_4_2]" id="q_4_2_b" value="2"/> 1 week-end</label>
                            </div>
                            <div class="field">
                                <label for="q_4_2_c"><input type="radio" name="form[q_4_2]" id="q_4_2_c" value="3"/> 2 à 3 nuits</label>
                            </div>
                            <div class="field">
                                <label for="q_4_2_d"><input type="radio" name="form[q_4_2]" id="q_4_2_d" value="4"/> 1 semaine</label>
                            </div>
                            <div class="field">
                                <label for="q_4_2_e"><input type="radio" name="form[q_4_2]" id="q_4_2_e" value="5"/> Plus d'une semaine</label>
                            </div>
                        </div>
                        <div class="col col1"></div>

                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>(Si plus de 1 jour en Qab) Q4c. Durant ce séjour, où résidez-vous principalement ?</h4>
                            <div class="field">
                                <label for="q_4_3_a"><input type="radio" name="form[q_4_3]" id="q_4_3_a" value="1"/> Dans votre résidence principale</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_b"><input type="radio" name="form[q_4_3]" id="q_4_3_b" value="2"/> Dans votre résidence secondaire</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_c"><input type="radio" name="form[q_4_3]" id="q_4_3_c" value="3"/> Chez des amis</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_d"><input type="radio" name="form[q_4_3]" id="q_4_3_d" value="4"/> A l'hôtel Les Jardins de Beauval</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_e"><input type="radio" name="form[q_4_3]" id="q_4_3_e" value="5"/> Dans un autre hôtel ou en chambre d'hôtes</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_h"><input type="radio" name="form[q_4_3]" id="q_4_3_h" value="8"/> A la r&eacute;sidence de vacances Les Hameaux de Beauval</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_f"><input type="radio" name="form[q_4_3]" id="q_4_3_f" value="6"/> Dans un camping</label>
                            </div>
                            <div class="field">
                                <label for="q_4_3_g"><input type="radio" name="form[q_4_3]" id="q_4_3_g" value="7"/> Autre endroit</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q5               ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-6">
            <div class="wrapper">
                <div class="question">
                    <h1>Q5. Combien de temps a duré votre trajet jusqu'à Beauval ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col3">
                            <div class="field">
                                <label for="q_5_a"><input type="radio" name="form[q_5]" id="q_5_a" value="1"/> Moins d'1 heure</label>
                            </div>
                            <div class="field">
                                <label for="q_5_b"><input type="radio" name="form[q_5]" id="q_5_b" value="2"/> de 1 heure à 2 heures</label>
                            </div>
                            <div class="field">
                                <label for="q_5_c"><input type="radio" name="form[q_5]" id="q_5_c" value="3"/> Plus de 2 heures de trajet</label>
                            </div>
                        </div>
                        <div class="col col2"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ########################################               question Q6a Q6b Q6c         ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-7">
            <div class="wrapper">
                <div class="question">
                    <h1>Q6a et Q6b et Q6c. Personnellement, étiez vous déjà venu au ZooParc de Beauval ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="">Champs obligatoire</label>
                                <label for="q_6_a"><input type="radio" name="form[q_6]" id="q_6_a" value="1"/> Oui</label>
                            </div>
                            <div class="field">
                                <label for="q_6_b"><input type="radio" name="form[q_6]" id="q_6_b" value="0"/> Non</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>(si oui) Q6b. Combien de fois êtes-vous déjà venu, en comptant la visite que vous venez d'effectuer ?</h4>
                            <div class="field">
                                <label for="q_6_1_a"><input type="radio" name="form[q_6_1]" id="q_6_1_a" value="1"/> 2 fois</label>
                            </div>
                            <div class="field">
                                <label for="q_6_1_b"><input type="radio" name="form[q_6_1]" id="q_6_1_b" value="5"/> plus</label>
                            </div>
                            <!-- <div class="field">
                                <label for="q_6_1_b"><input type="radio" name="form[q_6_1]" id="q_6_1_b" value="2"/> 3 fois</label>
                            </div>
                            <div class="field">
                                <label for="q_6_1_c"><input type="radio" name="form[q_6_1]" id="q_6_1_c" value="3"/> 4 fois</label>
                            </div>
                            <div class="field">
                                <label for="q_6_1_d"><input type="radio" name="form[q_6_1]" id="q_6_1_d" value="4"/> 5 fois ou plus</label>
                            </div> -->
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>(si oui) Q6c. Et à  quand remonte votre précédente visite du ZooParc de Beauval ?</h4>
                            <div class="field">
                                <label for="q_6_2_a"><input type="radio" name="form[q_6_2]" id="q_6_2_a" value="1"/> Il y a moins de 1 an</label>
                            </div>
                            <div class="field">
                                <label for="q_6_2_b"><input type="radio" name="form[q_6_2]" id="q_6_2_b" value="2"/> Il y a 1 an environ</label>
                            </div>
                            <div class="field">
                                <label for="q_6_2_c"><input type="radio" name="form[q_6_2]" id="q_6_2_c" value="3"/> Il y a 2 ans environ</label>
                            </div>
                            <div class="field">
                                <label for="q_6_2_d"><input type="radio" name="form[q_6_2]" id="q_6_2_d" value="4"/> Il y a entre 3 et 5 ans</label>
                            </div>
                            <!-- <div class="field">
                                <label for="q_6_2_e"><input type="radio" name="form[q_6_2]" id="q_6_2_e" value="5"/> Il y a plus de 5 ans</label>
                            </div> -->
                            <div class="field">
                                <label for="q_6_2_f"><input type="radio" name="form[q_6_2]" id="q_6_2_f" value="6"/> Je ne me souviens pas</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q7a Q7b          ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-8">
            <div class="wrapper">
                <div class="question">
                    <h1>Q7a et Q7b. Concernant votre visite d'aujourd'hui, vous êtes-vous décidé au dernier moment ou l'aviez-vous programmée à l'avance ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_7_a"><input type="radio" name="form[q_7]" id="q_7_a" value="1"/> Visite décidée au plus 2-3 jours avant</label>
                            </div>
                            <div class="field">
                                <label for="q_7_b"><input type="radio" name="form[q_7]" id="q_7_b" value="2"/> Visite programmée à l'avance</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Q7b. Combien de semaines à l’avance ?</h4>
                            <div class="field">
                                <input type="text" name="form[q_7_1]" id="q_7_1" value="" placeholder="1" maxlength="2" style="width: 4em;"/>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q8a Q8b          ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-9">
            <div class="wrapper">
                <div class="question">
                    <h1>Q8a et Q8b. Saviez-vous avant de venir que le ZooParc de Beauval avait accueilli 2 pandas géants ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_8_a"><input type="radio" name="form[q_8]" id="q_8_a" value="1"/> Oui</label>
                            </div>
                            <div class="field">
                                <label for="q_8_b"><input type="radio" name="form[q_8]" id="q_8_b" value="0"/> Non</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>(si oui) Q8b. Cela a-t-il influencé votre décision de venir aujourd'hui ?</h4>
                            <div class="field">
                                <label for="q_8_1_a"><input type="radio" name="form[q_8_1]" id="q_8_1_a" value="1"/> Oui</label>
                            </div>
                            <div class="field">
                                <label for="q_8_1_b"><input type="radio" name="form[q_8_1]" id="q_8_1_b" value="0"/> Non</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q9               ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-10">
        <div class="wrapper">
        <div class="question">
            <h1>Q9. Quels sont tous les moyens qui vous ont permis d'entendre parler du ZooParc de Beauval et vous ont décidé à venir ?</h1>

            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_a"><input type="checkbox" name="form[q_9][q_9_0][way]" id="q_9_a" value="1"/> Bouche à oreille (famille, amis, etc)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_a"><input type="checkbox" name="form[q_9][q_9_0][way]" id="q_9_a" value="12"/> Réseaux sociaux (Facebook, Google+, Twitter, etc )</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_b"><input type="checkbox" name="form[q_9][q_9_1][way]" id="q_9_b" value="2"/> Affichage publicitaire</label>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col5">
                            <h4>Quel types d'affichages ?</h4>

                            <div class="field">
                                <label for="q_9_1_a"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_a" value="1"/> Grandes affiches</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_1_1_a"><input type="checkbox" name="form[q_9][q_9_1][where_1][paris]" id="q_9_1_1_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_1_1_b"><input type="checkbox" name="form[q_9][q_9_1][where_1][province]" id="q_9_1_1_b"/> Province</label></div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="q_9_1_b"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_b" value="2"/> Affiches sur les portes des magasins</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_1_2_a"><input type="checkbox" name="form[q_9][q_9_1][where_2][paris]" id="q_9_1_2_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_1_2_b"><input type="checkbox" name="form[q_9][q_9_1][where_2][province]" id="q_9_1_2_b"/> Province</label></div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="q_9_1_c"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_c" value="3"/> Affiches sur les arrières de bus</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_1_3_a"><input type="checkbox" name="form[q_9][q_9_1][where_3][paris]" id="q_9_1_3_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_1_3_b"><input type="checkbox" name="form[q_9][q_9_1][where_3][province]" id="q_9_1_3_b"/> Province</label></div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="q_9_1_d"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_d" value="4"/> Dans les centres commerciaux</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_1_4_a"><input type="checkbox" name="form[q_9][q_9_1][where_4][paris]" id="q_9_1_4_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_1_4_b"><input type="checkbox" name="form[q_9][q_9_1][where_4][province]" id="q_9_1_4_b"/> Province</label></div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="q_9_1_e"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_e" value="5"/> Affichages animés (vidéo) dans les centres commerciaux de la région parisienne</label>
                            </div>
                            <div class="field">
                                <label for="q_9_1_f"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_f" value="6"/> Affichage dans le metro parisien</label>
                            </div>
                            <div class="field">
                                <label for="q_9_1_g"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_g" value="7"/> Affichage sur le périphérique parisien</label>
                            </div>
                            <div class="field">
                                <label for="q_9_1_h"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_h" value="8"/> Affichage sur les quais de RER/trains de banlieue</label>
                            </div>
                            <div class="field">
                                <label for="q_9_1_i"><input type="checkbox" name="form[q_9][q_9_1][how][]" id="q_9_1_i" value="9"/> Bus entièrement recouvert à l'éffigie du ZooParc de Beauval en province</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_d"><input type="checkbox" name="form[q_9][q_9_3][way]" id="q_9_d" value="4"/> Articles/émissions dans les médias</label>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col5">
                            <h4>Merci de préciser</h4>
                            <div class="field">
                                <label for="q_9_3_a"><input type="checkbox" name="form[q_9][q_9_3][where][]" id="q_9_3_a" value="1"/> Emission de télévision</label>
                            </div>
                            <div class="field">
                                <label for="q_9_3_b"><input type="checkbox" name="form[q_9][q_9_3][where][]" id="q_9_3_b" value="2"/> Emission de radio</label>
                            </div>
                            <div class="field">
                                <label for="q_9_3_c"><input type="checkbox" name="form[q_9][q_9_3][where][]" id="q_9_3_c" value="3"/> Article dans la presse écrite (journal, magazine...)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_c"><input type="checkbox" name="form[q_9][q_9_2][way]" id="q_9_c" value="3"/> Publicité dans les médias</label>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col5">
                            <h4>Quel type de média ?</h4>
                            <div class="field">
                                <label for="q_9_2_a"><input type="checkbox" name="form[q_9][q_9_2][how][]" id="q_9_2_a" value="5"/> Publicité à la radio</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_2_1_a"><input type="checkbox" name="form[q_9][q_9_2][where_1][paris]" id="q_9_2_1_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_2_1_b"><input type="checkbox" name="form[q_9][q_9_2][where_1][province]" id="q_9_2_1_b"/> Province</label></div>
                                </div>
                            </div>
                            <div class="field">
                                <label for="q_9_2_c"><input type="checkbox" name="form[q_9][q_9_2][how][]" id="q_9_2_c" value="6"/> Jeu à la radio</label>
                            </div>
                            <div class="row">
                                <div class="col col1"></div>
                                <div class="col col5">
                                    <h4>Où était-ce ?</h4>
                                    <div class="field"><label for="q_9_2_2_a"><input type="checkbox" name="form[q_9][q_9_2][where_2][paris]" id="q_9_2_2_a"/> Paris/Banlieue</label></div>
                                    <div class="field"><label for="q_9_2_2_b"><input type="checkbox" name="form[q_9][q_9_2][where_2][province]" id="q_9_2_2_b"/> Province</label></div>
                                </div>
                            </div>
                            <!-- <div class="field">
                                <label for="q_9_2_a"><input type="checkbox" name="form[q_9][q_9_2][where][]" id="q_9_2_a" value="1"/> Publicité à la télévision</label>
                            </div>
                            <div class="field">
                                <label for="q_9_2_b"><input type="checkbox" name="form[q_9][q_9_2][where][]" id="q_9_2_b" value="2"/> Lancement météo à la télévision</label>
                            </div>
                            <div class="field">
                                <label for="q_9_2_c"><input type="checkbox" name="form[q_9][q_9_2][where][]" id="q_9_2_c" value="3"/> Jeu, publicité à la radio</label>
                            </div> -->
                            <div class="field">
                                <label for="q_9_2_d"><input type="checkbox" name="form[q_9][q_9_2][how][]" id="q_9_2_d" value="4"/> Publicité dans la presse écrite, un guide touristique</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_e"><input type="checkbox" name="form[q_9][q_9_4][way]" id="q_9_e" value="5"/> Prospectus</label>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col5">
                            <h4>Où avez-vous vu/obtenu ce(s) prospectus</h4>
                            <div class="field">
                                <label for="q_9_4_a"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_a" value="1"/> Dans un hôtel, un restaurant, un Office de tourisme</label>
                            </div>
                            <div class="field">
                                <label for="q_9_4_b"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_b" value="2"/> Dans une station-service/un resturant d'autoroute</label>
                            </div>
                            <div class="field">
                                <label for="q_9_4_c"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_c" value="3"/> un super/hypermarché</label>
                            </div>
                            <div class="field">
                                <label for="q_9_4_d"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_d" value="4"/> Dans votre boîte aux lettres</label>
                            </div>
                            <div class="field">
                                <label for="q_9_4_e"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_e" value="5"/> Sur le part-brise de votre voiture</label>
                            </div>
                            <div class="field">
                                <label for="q_9_4_e"><input type="checkbox" name="form[q_9][q_9_4][where][]" id="q_9_4_e" value="6"/> Distribué dans la rue</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_f"><input type="checkbox" name="form[q_9][q_9_5][way]" id="q_9_f" value="6"/> Promotion dans un supermarché</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_g"><input type="checkbox" name="form[q_9][q_9_6][way]" id="q_9_g" value="7"/> Ecole de votre enfant</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_h"><input type="checkbox" name="form[q_9][q_9_7][way]" id="q_9_h" value="8"/> Affichage/billets dans votre entreprise (CE)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_i"><input type="checkbox" name="form[q_9][q_9_8][way]" id="q_9_i" value="9"/> Guides touristiques</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_j"><input type="checkbox" name="form[q_9][q_9_9][way]" id="q_9_j" value="10"/> Site web du ZooParc de Beauval</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col6">
                    <div class="field">
                        <label for="q_9_k"><input type="checkbox" name="form[q_9][q_9_10][way]" id="q_9_k" value="11"/> Publicité sur un site internet</label>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q10              ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-11">
            <div class="wrapper">
                <div class="question">
                    <h1>Q10. Avant de venir au ZooParc de Beauval:</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Vous êtes-vous connecté à notre site www.zoobeauval.com ?</h4>
                            <div class="field"><label for="q_10_a"><input type="radio" name="form[q_10]" id="q_10_a" value="1"/> Oui</label></div>
                            <div class="field"><label for="q_10_b"><input type="radio" name="form[q_10]" id="q_10_b" value="0"/> Non</label></div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Avez-vous téléphoné au ZooParc de Beauval pour obtenir des renseignements ?</h4>
                            <div class="field"><label for="q_10_1_a"><input type="radio" name="form[q_10_1]" id="q_10_1_a" value="1"/> Oui</label></div>
                            <div class="field"><label for="q_10_1_b"><input type="radio" name="form[q_10_1]" id="q_10_1_b" value="0"/> Non</label></div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q11              ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-12">
            <div class="wrapper">
                <div class="question">
                    <h1>Q11. Globalement, en ce qui concerne la visite du ZooParc de Beauval, diriez-vous que vous avez :</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col3">
                            <div class="field">
                                <label for="q_11_a"><input type="radio" name="form[q_11]" id="q_11_a" value="1"/> Beaucoup aimé</label>
                            </div>
                            <div class="field">
                                <label for="q_11_b"><input type="radio" name="form[q_11]" id="q_11_b" value="2"/> Aimé</label>
                            </div>
                            <div class="field">
                                <label for="q_11_c"><input type="radio" name="form[q_11]" id="q_11_c" value="3"/> Peu aimé</label>
                            </div>
                            <div class="field">
                                <label for="q_11_d"><input type="radio" name="form[q_11]" id="q_11_d" value="4"/> Pas du tout aimé</label>
                            </div>
                        </div>
                        <div class="col col2"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ##########################################            question Q12a Q12b Q12c          ################################################ -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-13">
            <div class="wrapper">
                <div class="question">
                    <h1>Q12a Q12b Q12c. Vous êtes-vous arrêté dans un point de restauration ?</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field"><label for="q_12_a"><input type="radio" name="form[q_12]" id="q_12_a" value="1"/> Oui</label></div>
                            <div class="field"><label for="q_12_b"><input type="radio" name="form[q_12]" id="q_12_b" value="0"/> Non</label></div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Q12b. (si oui) Lequel ?</h4>
                            <div class="field"><label for="q_12_1_a"><input type="radio" name="form[q_12_1]" id="q_12_1_a" value="1"/> Self-service Le Tropical</label></div>
                            <div class="field"><label for="q_12_1_b"><input type="radio" name="form[q_12_1]" id="q_12_1_b" value="2"/> Crêperie La Roseraie</label></div>
                            <div class="field"><label for="q_12_1_c"><input type="radio" name="form[q_12_1]" id="q_12_1_c" value="3"/> L'Eucalyptus</label></div>
                            <div class="field"><label for="q_12_1_d"><input type="radio" name="form[q_12_1]" id="q_12_1_d" value="4"/> Les Lamentins</label></div>
                            <div class="field"><label for="q_12_1_e"><input type="radio" name="form[q_12_1]" id="q_12_1_e" value="5"/> Les Chats-pêcheurs</label></div>
                            <div class="field"><label for="q_12_1_f"><input type="radio" name="form[q_12_1]" id="q_12_1_f" value="6"/> La Savane</label></div>
                            <div class="field"><label for="q_12_1_g"><input type="radio" name="form[q_12_1]" id="q_12_1_g" value="7"/> Les Orangs-outans</label></div>
                            <div class="field"><label for="q_12_1_h"><input type="radio" name="form[q_12_1]" id="q_12_1_h" value="8"/> La Pagode</label></div>
                            <div class="field"><label for="q_12_1_i"><input type="radio" name="form[q_12_1]" id="q_12_1_i" value="9"/> Un chalet</label></div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Q12c. Concernant la qualité de la restauration, êtes-vous :</h4>
                            <div class="field"><label for="q_12_2_a"><input type="radio" name="form[q_12_2]" id="q_12_2_a" value="1"/> Très satisfait(e)</label></div>
                            <div class="field"><label for="q_12_2_b"><input type="radio" name="form[q_12_2]" id="q_12_2_b" value="2"/> Satisfait(e)</label></div>
                            <div class="field"><label for="q_12_2_c"><input type="radio" name="form[q_12_2]" id="q_12_2_c" value="3"/> Peu satisfait(e)</label></div>
                            <div class="field"><label for="q_12_2_d"><input type="radio" name="form[q_12_2]" id="q_12_2_d" value="4"/> Pas du tout satisfait(e)</label></div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q13              ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-14">
            <div class="wrapper">
                <div class="question">
                    <h1>Q13. Remarques et suggestions</h1>

                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <textarea name="form[q_13]" id="q_13"></textarea>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################               question Q14a Q14b          ################################################# -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-15">
            <div class="wrapper">
                <div class="question">
                    <h1>Q14a et Q14b. Aimeriez-vous recevoire 2 ou 3 fois par an des informations sur le ZooParc de Beauval (nouveautés, offres promotionnelles...) ?</h1>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_14_a"><input type="radio" name="form[q_14]" id="q_14_a" value="1"/> Oui</label>
                            </div>
                            <div class="field">
                                <label for="q_14_b"><input type="radio" name="form[q_14]" id="q_14_b" value="0"/> Non</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <h4>Q14b. Et sur l'hôtel Les Jardins de Beauval ?</h4>
                            <div class="field">
                                <label for="q_14_1_a"><input type="radio" name="form[q_14_1]" id="q_14_1_a" value="1"/> Oui</label>
                            </div>
                            <div class="field">
                                <label for="q_14_1_b"><input type="radio" name="form[q_14_1]" id="q_14_1_b" value="0"/> Non</label>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################                   civilite              ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-16">
            <div class="wrapper">
                <div class="question">
                    <h1>Civilités</h1>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col4">
                            <div class="field">
                                <label for="q_15_1_a"><input type="radio" name="form[q_15_1]" value="Mme, Mlle" id="q_15_1_a"/> Mme, Mlle</label>
                                <label for="q_15_1_b"><input type="radio" name="form[q_15_1]" value="Mr" id="q_15_1_b" /> Mr</label>
                            </div>
                            <div class="field">
                                <label for="nom">Nom</label><input type="text" name="form[q_15_2]" id="nom"/>
                            </div>
                            <div class="field">
                                <label for="prenom">Prenom</label><input type="text" name="form[q_15_3]" id="prenom"/>
                            </div>
                            <div class="field">
                                <label for="email">Email</label><input type="text" name="form[q_15_4]" id="email"/>
                            </div>
                        </div>
                        <div class="col col1"></div>
                    </div>

                </div>
            </div>
        </div>
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ###########################################                 validation              ################################################### -->
    <!-- ####################################################################################################################################### -->
    <!-- ####################################################################################################################################### -->
        <div class="section" id="question-17">
            <div class="wrapper">
                <div class="question">
                    <h1>Validation</h1>
                    <div class="error">
                        <div class="error-msg">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam blanditiis eius eos laudantium pariatur possimus quasi quis! A deserunt placeat provident veniam. Alias cumque dolore eius neque nobis nulla reprehenderit sunt unde veniam vero. Animi consectetur consequuntur, corporis est exercitationem ipsa maiores, natus odio quis ratione sed sequi tempora voluptatum!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col1"></div>
                        <div class="col col2 text-center">
                            <button type="submit" class="btn" id="submitBtn">Enregistrer</button>
                        </div>
                        <div class="col col2 text-center">
                            <button type="reset" class="btn">Annuler</button>
                        </div>
                        <div class="col col1"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="navigator">
    <div class="navBtn grip" id="navigator-grip"></div>
    <div class="navBtn" id="navigator-first"><i class="fa fa-angle-double-up"></i></div>
    <div class="navBtn" id="navigator-prev"><i class="fa fa-angle-up"></i></div>
    <div class="navBtn" id="navigator-next"><i class="fa fa-angle-down"></i></div>
    <div class="navBtn" id="navigator-last"><i class="fa fa-angle-double-down"></i></div>
</div>
<!--<script src="/web/js/apps/main.js"></script>-->
<script src="/js/apps/main.js"></script>
</body>
</html>
