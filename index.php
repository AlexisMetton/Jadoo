<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Restaurant</title>
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="form.css">
</head>
<!--img n'ont pas de Alt-->
<body>
    <?php
        if(isset($_COOKIE['cookieForm'])){
    ?>
            <?php setcookie('cookieForm', 1, time()-3600);?>
            <p id="cookieForm" class="cookieForm">Formulaire bien envoyé !</p>
    <?php
        }
    ?>
    <?php
            $servname = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "jadoo";

            try {
                $conn = new PDO("mysql:host=$servname;dbname=$dbname",$user, $pass);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sth = $conn->prepare ("SELECT Nom, Description, Image, Nouveau
                                        FROM plats
                                        INNER JOIN categories ON plats.Id_Categorie = categories.Id_Categorie 
                                        WHERE Categorie = 'plats_chaud'
                                        ORDER BY Id DESC
                                        LIMIT 3");
                $sth->execute();

                $plats = $sth->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        ?>
        <?php
            $servname = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "jadoo";

            try {
                $conn = new PDO("mysql:host=$servname;dbname=$dbname",$user, $pass);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sth = $conn->prepare ("SELECT Nom, Description, Image
                                        FROM plats
                                        INNER JOIN categories ON plats.Id_Categorie = categories.Id_Categorie 
                                        WHERE Categorie = 'makis' 
                                        LIMIT 4");
                $sth->execute();

                $makis = $sth->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        ?>
        <?php
    $servname = "localhost";
    $dbname = "jadoo";
    $user = "root";
    $pass = "";
    try{
        //On se connecte à la BDD
        $conn = new PDO("mysql:host=$servname;dbname=$dbname",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //On crée une table form
        $sth = $conn->prepare ("SELECT Nom, Prenom, Email, Message
                                FROM `messages`");
        $sth->execute();

        $form = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        echo 'Erreur : '.$e->getMessage();
    }
?>

    <header>
        <div class="logo" id="logo1">
            <div class="logojadoo">
            <img src="Images/logo_jadoo_1.svg" alt="logo Jadoo" height="40px">
            </div>
            <div class="jadoo">
            <img src="Images/logo_jadoo_2.svg" alt="Jadoo" height="35px">
            </div>
        </div>
        <nav>
            <div class = "menu">
                <ul>
                    <li><a href="">Les nouveautés</a></li>
                    <li><a href="">Découvrir</a></li>
                    <li><a href="">Commander</a></li>
                    <li><a href="">Contactez-nous</a></li>
                    <img src="Images/burger_icon.svg">
                </ul>
            </div>
        </nav>
    </header>
    <div class="presentation">
        <h2>Un voyage culinaire gourmet et gourmand.</h2>
        <h1>Bienvenue <br>au restaurant <br>Jadoo</h1>
        <p>Jadoo vous accueille dans son ambiance zen et épurée, <br> idéale pour découvrir ou redécouvrir la cuisine <br>gastronomique du Chef Junichi IIDA.</p>
        <button >Découvrir la carte</button> <!--Ne pas oublier de mettre le lien-->
        <br><br><br>
    </div>
    <div class="Decouvrir">
        <br>
        <div class="imageplus">
            <img src="Images/decor_1.svg">
        </div>
        <h3>Découvrez</h3>
        <h2>Les nouveautés Jadoo</h2>
        <div class="plat">
            <?php
                foreach($plats as $plat){
            ?>
                <div class="<?php echo $plat['Nouveau']; ?>">

                        <?php
                        if($plat['Nouveau']=="nouveau3"){?>
                            <div class="decofilet">
                                <div class="imagefilet">
                                <img src="Images/decoration_filet.svg">
                                </div>
                                <div class = "nouveau">
                                    <img src="Images/<?php echo $plat['Image']; ?>">
                                    <p><?php echo utf8_encode($plat['Description']); ?></p>
                                </div>
                            </div>
                        <?php
                        } else{ ?>
                        <div class = "nouveau">
                            <img src="Images/<?php echo $plat['Image']; ?>">
                            <p><?php echo utf8_encode($plat['Description']); ?></p>
                        </div>
                        <?php
                        }
                        ?>
                </div>
                <?php
                    }
                ?>
            <!-- <div class="nouveau1">
                <div class = "nouveau">
                    <img src="Images/plat_1.png">
                    <p>Boulettes de poulet au <br>gingembre sauce sucrée <br>salée "Tsukuné"</p>
                </div>
            </div>
            <div class="nouveau2">
                <div class = "nouveau">
                    <img src="Images/plat_2.png">
                    <p>Nouilles japonaises <br>chaudes à base de farine<br> de blé "Udon"</p>
                </div>
            </div>
            <div class="nouveau3">
                <div class="decofilet">
                    <div class="imagefilet">
                        <img src="Images/decoration_filet.svg">
                    </div>
                    <div class = "nouveau">
                        <img src="Images/plat_3.png">
                        <p>Échine de porc panée à la<br> japonaise "Tonkatsu-<br>Teishoku"</p><br>
                    </div>
                </div>
            </div>-->
        </div>
        <div class = "platsushis">
        <?php
            foreach($makis as $maki){
        ?>
                <div class="decorose">
                    <span><img src="Images/decoration_rose.svg"></span>
                    <div class="sushis">
                        <img src="Images/<?php echo $maki['Image'] ?>">
                        <div class="encadrement">
                            <h4><?php echo utf8_encode($maki['Nom']); ?></h4>
                            <p><?php echo utf8_encode($maki['Description']); ?></p>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>
                <!-- <div class="decorose">
                    <span><img src="Images/decoration_rose.svg"></span>
                    <div class="sushis">
                        <img src="Images/maki_1.png">
                        <div class="encadrement">
                            <h4>California Tobiko</h4>
                            <p>Saumon, thon,<br> mayonnaise</p>
                        </div>
                    </div>
                </div>
                <div class="decorose">
                    <span><img src="Images/decoration_rose.svg"></span>
                    <div class="sushis">
                        <img src="Images/maki_2.png">
                        <div class="encadrement">
                            <h4>California Rolls</h4>
                            <p>Saumon, avocat et <br>mayonnaise</p>
                        </div>
                    </div>
                </div>
            <div class="decorose">
                <span><img src="Images/decoration_rose.svg"></span>
                <div class="sushis">
                    <img src="Images/maki_3.png">
                    <div class="encadrement">
                        <h4>Ebi</h4>
                        <p>Crevette, avocat,<br> menthe, coriandre</p>
                    </div>
                </div>
            </div>
            <div class="decorose">
                <span><img src="Images/decoration_rose.svg"></span>
                <div class="sushis">
                    <img src="Images/maki_4.png">
                    <div class="encadrement">
                        <h4>Ikura Rolls</h4>
                        <p>Oeufs de saumon</p><br>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <button >Découvrir la carte</button>
    <div class="voyage">
        <div class="Imagesbis">
            <img src="Images/visu_video.jpg">
            <div class="playbis">
                <img src="Images/button_play.svg">
            </div>
        </div>
        <div class="premiere">
            <div class="Images">
                <img src="Images/visu_video.jpg">
                <div class="play">
                    <img src="Images/button_play.svg">
                </div>
            </div>
            <h1>Un voyage <br>gastronomique <br>entre le Japon <br>et la France...</h1>
            <p>Passé par des maisons étoilées en France, le cuisiner <br>japonais s'est forgé une solide expérience dans <br>l'hexagone : aujourd'hui franc-comtois d'adoption, il <br>maîtrise aujourd'hui les mélanges de cultures et de <br>saveurs chaque jour au sein de son restaurant <br>gastronomique.</p>
            <div class="deuxphotos1">
                <div class="photo1"></div>   
                <div class="photo2"></div>   
            </div>
        </div>
        <img class ="imagechef" src="Images/illustration_chef.jpg">
        <div class="deuxphotos">
            <img src="Images/wrapper_illustration_1.jpg">
            <span><img src="Images/wrapper_illustration_2.jpg"></span>
        </div>   
        <div class="seconde">
            <div class="contenu">
            <h4>Rapide et pratique</h4>
            <h2><span>Commandez</span> sur le <br>site Jadoo</h2>
            <div class="ubereats">
                <img src="Images/logo_uberEats.png">
                <div class="textseconde">
                    <h5>UberEats</h5>
                    <p>Commandez tous vos plats depuis UberEats</p>
                </div>
            </div>
            <div class="jadoofr">
                <img src="Images/logo_jadoo_1.svg">
                <div class="textseconde">
                    <h5>Jaddo.fr</h5>
                    <p>Ou commander en ligne sur le site officiel de Jadoo</p>
                </div>
            </div>
            <div class="livraison">
                <img src="Images/logo_transport.png">
                <div class="textseconde">
                    <h5>Livraison ultra rapide</h5>
                    <p>Soyez livré en 20 minutes maximum</p>
                </div>
            </div>
            <button >Découvrir la carte</button><!--Ne pas oublier de mettre le lien-->
        </div>
        </div>
    </div>
    <div class="contact">
        <h3>Prendre Rendez-vous</h3>
        <h2>Contactez-nous <br>pour réserver au restaurant</h2>
        <div class="formulaire">
            <div class="textformulaire">
                <h5>Formulaire de contact</h5>
                <p class="formulairep">Remplissez le formulaire ci-dessous <br>pour nous contacter</p>
                <div class="nomprenom">
                    <form method="post" action="formulaire.php">
                    <div class="nom">
                        <p>Nom</p>
                        <input type="text" id="nom" name="nom" placeholder="Nom" minlength="2" maxlength="25" required>
                    </div>
                    <div class="prenom">
                        <p>Prénom</p>
                        <input type="text" id="prenom" name="prenom" placeholder="Prénom" minlength="2" maxlength="25" required required>
                    </div>
                </div>
                <p>Adresse e-mail</p>
                <input class="mailinput" type="email" id="name" name="mail" placeholder="monAdresseMail@gmail.com" required>
                <p>Message</p>
                <input class="messageinput" type="textarea" id="message" name="message" placeholder="Votre message/demande de réservation" required><br><br>
                <div class="envoyer">
                    <input type="submit" value="Envoyer">
                </div></form>
            </div>
            <img src="Images/illustration_formulaire.jpg">
        </div>
    </div>
    <footer>
        <div class="logo" id="logofooter">
            <div class="logojadoo" id="logofooter1">
            <img src="Images/logo_jadoo_1.svg" alt="logo Jadoo" height="60px">  &nbsp; 
            <img src="Images/logo_jadoo_2.svg" alt="Jadoo" height="55px"><br>
            <p>Un voyage gastronomique entre <br>le Japon et la France</p>
            </div>
        </div>
        <div class="Centre">
            <div class="Centre1">
                <h4>Restaurant</h4>
                <a href="">Nouveautés</a>
                <a href="">Découvrir</a>
                <a href="">Commander</a>
            </div>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <div class="Centre2">
                <h4>Contact</h4>
                <a href="">Prendre RDV</a>
            </div>
        </div>
        <div class="Droite">
            <img src="Images/logo_uberEats_2.svg">
            <p>Téléchargez UberEats</p>
            <div class="button">
                <div class="button1">
                    <button>Google Play</button>
                </div>
                &nbsp;
                <div class="button2">
                    <button>Apple Store</button>
                </div>
            </div>
        </div>
    </footer>
    <div class="mention">
        <p>Tous droits réservés @Jadoo.com</p>
    </div>
<!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>