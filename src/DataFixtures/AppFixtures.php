<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Créer les utilisateurs
        $admin = new User();
        $admin->setEmail('admin@murim.com');
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $manager->persist($admin);

        $user1 = new User();
        $user1->setEmail('jin@murim.com');
        $user1->setUsername('cultivateur_jin');
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'password'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('feng@murim.com');
        $user2->setUsername('maitre_feng');
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'password'));
        $manager->persist($user2);

        // Créer les catégories
        $categories = [
            ['Cultivation', 'Techniques et méthodes de cultivation spirituelle', '#dc2626'],
            ['Arts Martiaux', 'Techniques de combat et styles martiaux', '#d97706'],
            ['Sectes', 'Organisations et clans du monde Murim', '#7c3aed'],
            ['Histoire', 'Chroniques et légendes du monde martial', '#059669'],
            ['Alchimie', 'Art de la création de pilules et élixirs', '#0891b2']
        ];

        $categoryObjects = [];
        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->setName($categoryData[0]);
            $category->setDescription($categoryData[1]);
            $category->setColor($categoryData[2]);
            $manager->persist($category);
            $categoryObjects[] = $category;
        }

        // Créer les articles
        $articlesData = [
            [
                'title' => 'Les Fondements de la Cultivation Spirituelle',
                'excerpt' => 'Guide complet sur les bases de la cultivation pour les débutants du Murim.',
                'content' => "La cultivation spirituelle est l'art ancestral qui permet aux pratiquants du Murim d'atteindre des niveaux de puissance extraordinaires. Cette pratique millénaire repose sur trois piliers fondamentaux : la purification du corps, l'élévation de l'esprit et l'harmonisation avec les énergies cosmiques.

## Les Étapes de la Cultivation

### 1. La Purification Corporelle
Avant de pouvoir manipuler l'énergie spirituelle, le cultivateur doit d'abord purifier son enveloppe charnelle. Cette étape implique :
- L'élimination des toxines accumulées
- Le renforcement des méridiens
- L'ouverture des points d'acupuncture

### 2. L'Éveil Spirituel
Une fois le corps préparé, l'esprit doit s'éveiller aux énergies subtiles qui l'entourent. Cette phase nécessite :
- Une méditation profonde et régulière
- La compréhension des flux énergétiques
- Le développement de la perception spirituelle

### 3. L'Harmonisation Cosmique
Le stade ultime consiste à synchroniser son être avec les rythmes universels :
- Alignement avec les cycles lunaires et solaires
- Communion avec les éléments naturels
- Transcendance des limites physiques

## Conseils pour les Débutants

Pour ceux qui souhaitent débuter leur parcours de cultivation, voici quelques recommandations essentielles :

1. **Patience et Persévérance** : La cultivation est un chemin long qui demande une pratique constante
2. **Maître Qualifié** : Trouvez un guide expérimenté pour éviter les déviations dangereuses
3. **Environnement Propice** : Choisissez un lieu calme, riche en énergie spirituelle
4. **Discipline Personnelle** : Maintenez une routine stricte de pratique quotidienne

La voie de la cultivation n'est pas sans dangers. Les pratiquants imprudents risquent la déviation du qi, pouvant mener à la folie ou même à la mort. C'est pourquoi il est crucial de progresser étape par étape, sans brûler les étapes.",
                'author' => $admin,
                'category' => $categoryObjects[0] // Cultivation
            ],
            [
                'title' => 'L\'École du Poing de Fer : Technique Légendaire',
                'excerpt' => 'Découvrez les secrets de cette technique martiale redoutable qui a façonné l\'histoire du Murim.',
                'content' => "L'École du Poing de Fer représente l'une des techniques martiales les plus redoutables et respectées du monde Murim. Fondée il y a plus de huit cents ans par le légendaire Maître Tie Quan, cette école a produit certains des guerriers les plus puissants de l'histoire.

## Origines et Histoire

L'École du Poing de Fer fut créée dans les montagnes reculées du Nord, où Maître Tie Quan développa sa technique révolutionnaire après avoir observé la résistance extraordinaire du métal forgé. Il comprit que le corps humain pouvait être transformé de la même manière, devenant aussi dur et résistant que l'acier le plus pur.

### Les Trois Niveaux de Maîtrise

**Niveau Bronze** : Le pratiquant apprend à durcir sa peau et ses muscles superficiels. À ce stade, il peut briser des planches de bois et résister aux coups ordinaires.

**Niveau Argent** : La technique pénètre plus profondément, renforçant les os et les organes internes. Le guerrier peut alors affronter des armes blanches à mains nues.

**Niveau Or** : Le summum de la technique, où le corps entier devient une arme vivante. Seuls quelques maîtres dans l'histoire ont atteint ce niveau légendaire.

## Méthodes d'Entraînement

L'entraînement du Poing de Fer est réputé pour sa rigueur extrême :

### Entraînement Physique
- Frappe répétée contre des surfaces de plus en plus dures
- Bains dans des décoctions d'herbes médicinales spéciales
- Exercices de respiration pour canaliser le qi vers les membres

### Entraînement Mental
- Méditation pour développer la concentration
- Visualisation de l'énergie circulant dans le corps
- Maîtrise de la douleur et de la peur

## Techniques Secrètes

Les véritables secrets de l'École du Poing de Fer ne sont transmis qu'aux disciples les plus dévoués :

**Poing Briseur de Montagne** : Un coup capable de fendre la roche
**Parade du Bouclier de Fer** : Une défense impénétrable
**Frappe des Mille Échos** : Une attaque qui résonne dans tout le corps de l'adversaire

## Dangers et Précautions

La pratique du Poing de Fer n'est pas sans risques. De nombreux pratiquants ont subi des blessures permanentes ou ont vu leur cultivation déviée par un entraînement trop intensif. Il est essentiel de :

- Progresser graduellement sans forcer
- Utiliser les bonnes herbes médicinales pour la récupération
- Maintenir l'équilibre entre force et souplesse
- Ne jamais négliger l'aspect spirituel de la technique

Aujourd'hui, l'École du Poing de Fer continue d'attirer de nombreux aspirants guerriers, mais seuls les plus déterminés parviennent à maîtriser ne serait-ce que les bases de cette technique légendaire.",
                'author' => $user1,
                'category' => $categoryObjects[1] // Arts Martiaux
            ],
            [
                'title' => 'La Secte du Lotus Noir : Mystères et Légendes',
                'excerpt' => 'Plongez dans l\'histoire fascinante de l\'une des sectes les plus énigmatiques du Murim.',
                'content' => "Parmi les organisations les plus mystérieuses du monde Murim, la Secte du Lotus Noir occupe une place particulière. Fondée dans l'ombre et opérant depuis les profondeurs des marécages interdits, cette secte a toujours fasciné autant qu'elle a terrifié les autres pratiquants du monde martial.

## Les Origines Obscures

La Secte du Lotus Noir fut établie il y a environ six siècles par une figure légendaire connue seulement sous le nom de \"Maître des Ombres\". Selon les rares témoignages qui nous sont parvenus, ce mystérieux fondateur était un ancien moine bouddhiste qui avait sombré dans les arts interdits après avoir découvert des techniques de cultivation basées sur l'absorption de l'énergie vitale d'autrui.

### La Philosophie du Lotus Noir

Contrairement aux écoles traditionnelles qui prônent l'harmonie et l'équilibre, la Secte du Lotus Noir enseigne que :

- La puissance véritable ne peut être obtenue que par la domination
- L'énergie des faibles doit nourrir la force des élus
- Les règles morales sont des chaînes qui limitent le potentiel humain
- Seuls les plus impitoyables méritent de transcender leur condition mortelle

## Structure et Hiérarchie

La secte est organisée selon une hiérarchie stricte et secrète :

**Le Patriarche Suprême** : Leader absolu, son identité reste inconnue
**Les Cinq Vénérables** : Maîtres des différentes branches de la secte
**Les Protecteurs d'Ombre** : Guerriers d'élite chargés de la sécurité
**Les Disciples Internes** : Membres ayant prouvé leur loyauté absolue
**Les Disciples Externes** : Novices en période d'évaluation

## Techniques Secrètes

La Secte du Lotus Noir est redoutée pour ses techniques uniques et terrifiantes :

### Arts de l'Absorption
- **Drain Vital** : Technique permettant d'absorber l'énergie vitale d'un adversaire
- **Parasitage Spirituel** : Implantation d'une partie de son qi dans un ennemi pour le contrôler
- **Communion des Ombres** : Fusion temporaire avec les esprits des morts

### Arts du Contrôle Mental
- **Suggestion Noire** : Manipulation subtile de la volonté d'autrui
- **Cauchemar Éveillé** : Projection d'illusions terrifiantes dans l'esprit de la cible
- **Marque de Servitude** : Asservissement permanent d'un individu

## Les Rituels Interdits

La secte pratique des rituels que les autres écoles considèrent comme abominables :

**Cérémonie de l'Éveil Noir** : Initiation des nouveaux membres par absorption d'énergie corrompue
**Rituel de la Lune Sanglante** : Sacrifice collectif pour augmenter la puissance du groupe
**Communion avec les Anciens** : Invocation des esprits des anciens maîtres de la secte

## Ennemis et Alliances

La Secte du Lotus Noir entretient des relations complexes avec les autres organisations :

### Ennemis Jurés
- L'Alliance des Sectes Orthodoxes
- Le Temple du Lotus Blanc (leur opposé philosophique)
- La Ligue des Héros Justiciers

### Alliances Secrètes
- Certaines sectes démoniaques mineures
- Des marchands corrompus qui financent leurs activités
- Des officiels gouvernementaux séduits par leurs promesses de pouvoir

## Mystères Non Résolus

Malgré les siècles d'existence de la secte, de nombreux mystères demeurent :

- L'emplacement exact de leur quartier général principal
- L'identité véritable du Patriarche Suprême actuel
- La nature exacte de leurs techniques les plus secrètes
- Leurs véritables objectifs à long terme

## Impact sur le Monde Martial

L'influence de la Secte du Lotus Noir sur le Murim est indéniable :

- Elle a poussé les sectes orthodoxes à s'unir face à la menace commune
- Ses techniques ont inspiré (dans le mal) d'autres organisations
- Elle maintient un équilibre de la terreur qui influence la politique du monde martial
- Ses actions ont façonné de nombreux événements historiques majeurs

Aujourd'hui encore, la simple mention de la Secte du Lotus Noir suffit à faire frémir les plus braves guerriers. Car dans l'ombre, ses membres continuent de tisser leurs toiles, attendant le moment propice pour révéler leurs véritables ambitions au grand jour.",
                'author' => $user2,
                'category' => $categoryObjects[2] // Sectes
            ],
            [
                'title' => 'Les Grandes Guerres du Murim : Chronique des Conflits',
                'excerpt' => 'Retour sur les événements qui ont façonné l\'histoire du monde martial.',
                'content' => "Il y a mille ans, le monde martial fut secoué par une série de conflits qui changèrent à jamais l'équilibre des forces dans le Murim. Ces guerres, connues sous le nom de \"Grandes Guerres du Murim\", marquèrent la fin d'une ère de paix relative et l'émergence de nouvelles puissances qui dominent encore aujourd'hui le paysage martial.

## Contexte Historique

Avant les Grandes Guerres, le monde Murim était dominé par l'Empire des Cinq Dragons, une alliance de cinq sectes majeures qui maintenait l'ordre depuis plus de trois siècles. Cette période, appelée \"l'Âge d'Or du Murim\", était caractérisée par :

- Une paix relative entre les différentes écoles
- Un développement florissant des arts martiaux
- Des échanges culturels et techniques entre les sectes
- Une prospérité économique générale

Cependant, cette stabilité cachait des tensions croissantes qui allaient bientôt exploser.

## Les Causes du Conflit

### La Découverte des Manuscrits Anciens

Tout commença par la découverte, dans les ruines d'un temple oublié, de manuscrits contenant des techniques de cultivation révolutionnaires. Ces textes, attribués aux légendaires \"Immortels Primordiaux\", promettaient un pouvoir dépassant tout ce qui était connu jusqu'alors.

### La Rivalité des Héritiers

La mort simultanée des cinq patriarches de l'Empire des Cinq Dragons créa une crise de succession sans précédent. Leurs héritiers, au lieu de maintenir l'alliance, commencèrent à se disputer non seulement le leadership de leurs propres sectes, mais aussi la domination de l'ensemble du monde martial.

### L'Émergence des Sectes Démoniaques

Profitant du chaos naissant, plusieurs sectes pratiquant les arts interdits sortirent de l'ombre. Menées par le mystérieux \"Empereur Démoniaque\", elles formèrent une alliance hostile déterminée à renverser l'ordre établi.

## Première Guerre : La Guerre des Manuscrits (An 1023-1027)

Le premier conflit éclata lorsque la Secte du Dragon d'Azur tenta de s'emparer de tous les manuscrits anciens. Cette guerre se caractérisa par :

### Batailles Majeures
- **Bataille du Pic des Nuages** : Affrontement épique entre 10,000 guerriers
- **Siège de la Forteresse de Jade** : Résistance héroïque de la Secte du Phoenix Blanc
- **Massacre de la Vallée Rouge** : Intervention brutale des sectes démoniaques

### Conséquences
- Destruction de trois sectes mineures
- Première utilisation des techniques interdites à grande échelle
- Émergence de nouveaux héros et de nouveaux tyrans

## Deuxième Guerre : La Guerre de l'Empereur Démoniaque (An 1028-1035)

La plus longue et la plus destructrice des guerres vit l'alliance des sectes démoniaques tenter de conquérir l'ensemble du Murim.

### L'Empereur Démoniaque

Cette figure légendaire, dont l'identité véritable reste un mystère, possédait des pouvoirs qui défiaient l'entendement :
- Capacité à corrompre les techniques adverses
- Maîtrise de la nécromancie martiale
- Armée de guerriers morts-vivants

### La Grande Alliance

Face à cette menace existentielle, les sectes orthodoxes furent contraintes de s'unir :
- Formation de l'Alliance des Justes
- Mise en commun des techniques secrètes
- Création d'une armée unifiée de 50,000 guerriers

### Batailles Décisives
- **Bataille des Dix Mille Épées** : Plus grand affrontement de l'histoire du Murim
- **Siège de la Citadelle Noire** : Assaut final contre le quartier général démoniaque
- **Duel des Titans** : Combat légendaire entre l'Empereur Démoniaque et le Champion de l'Alliance

## Troisième Guerre : La Guerre de Succession (An 1036-1040)

Après la défaite de l'Empereur Démoniaque, l'Alliance des Justes se fragmenta, chaque secte cherchant à établir sa suprématie.

### Protagonistes Principaux
- **Maître Lame Céleste** de la Secte de l'Épée Divine
- **Patriarche Poing de Fer** de l'École du Combat Suprême
- **Dame Fleur de Lotus** de la Secte des Arts Subtils

### Innovations Tactiques
- Première utilisation de formations de combat complexes
- Développement de techniques de guerre psychologique
- Introduction d'armes martiales enchantées

## Conséquences des Grandes Guerres

### Transformation du Paysage Politique
- Disparition de l'Empire des Cinq Dragons
- Émergence de nouvelles puissances régionales
- Établissement du Conseil des Neuf Sectes

### Évolution des Arts Martiaux
- Développement de techniques de combat de masse
- Fusion de styles traditionnellement séparés
- Création de nouvelles écoles hybrides

### Impact Social
- Exode massif des populations civiles
- Création de villes fortifiées
- Émergence d'une classe de guerriers professionnels

## Héros et Légendes

Les Grandes Guerres virent naître de nombreuses figures légendaires :

### Héros de la Lumière
- **Saint Épée Chen Wei** : Vainqueur de l'Empereur Démoniaque
- **Maîtresse des Mille Techniques Li Mei** : Stratège géniale de l'Alliance
- **Moine Guerrier Fa Kong** : Défenseur des innocents

### Figures Tragiques
- **Prince Dragon Noir** : Héritier déchu devenu renégat
- **Dame Lune Sanglante** : Guerrière corrompue par les arts démoniaques
- **Maître des Ombres** : Espion légendaire aux loyautés multiples

## L'Héritage Contemporain

Mille ans après, l'influence des Grandes Guerres se fait encore sentir :

### Structures Politiques
- Le Conseil des Neuf Sectes gouverne encore le Murim
- Les traités de paix signés alors sont toujours en vigueur
- Les alliances forgées dans le conflit perdurent

### Traditions Martiales
- De nombreuses techniques actuelles furent développées pendant les guerres
- Les codes d'honneur modernes datent de cette époque
- Les rituels commémoratifs maintiennent la mémoire des héros

### Leçons Apprises
- L'importance de l'unité face aux menaces existentielles
- Les dangers de l'ambition démesurée
- La nécessité d'équilibrer pouvoir et responsabilité

Les Grandes Guerres du Murim demeurent un sujet d'étude fascinant pour tous ceux qui s'intéressent à l'histoire du monde martial. Elles nous rappellent que même dans un univers de pouvoirs extraordinaires, ce sont souvent les choix humains les plus fondamentaux qui déterminent le cours de l'histoire.",
                'author' => $admin,
                'category' => $categoryObjects[3] // Histoire
            ],
            [
                'title' => 'L\'Art de l\'Alchimie Martiale : Créer des Pilules Miraculeuses',
                'excerpt' => 'Maîtrisez l\'art ancestral de créer des élixirs qui décuplent les capacités martiales.',
                'content' => "L'alchimie martiale représente l'une des disciplines les plus complexes et les plus respectées du monde Murim. Combinant les connaissances des herbes médicinales, la maîtrise du feu spirituel et une compréhension profonde des énergies cosmiques, cette pratique permet de créer des pilules et élixirs aux propriétés extraordinaires.

## Histoire et Origines

L'art de l'alchimie martiale remonte aux premiers jours du Murim, lorsque les anciens sages découvrirent que certaines plantes, correctement préparées et infusées d'énergie spirituelle, pouvaient considérablement améliorer les capacités humaines.

### Les Pionniers
- **Sage des Mille Herbes** : Premier grand alchimiste connu
- **Maître Fourneau Céleste** : Inventeur des techniques de raffinage avancées
- **Dame Élixir Divin** : Créatrice des pilules de longévité

## Fondamentaux de l'Alchimie

### Les Trois Piliers

**1. Connaissance des Ingrédients**
L'alchimiste doit maîtriser les propriétés de centaines d'herbes, minéraux et substances rares :
- Ginseng millénaire pour la vitalité
- Racine de dragon pour la force
- Perles de lune pour la purification spirituelle
- Sang de phénix pour la régénération

**2. Maîtrise du Feu Spirituel**
Le feu ordinaire ne suffit pas pour l'alchimie martiale. L'alchimiste doit développer son propre feu spirituel :
- Feu de l'âme pour les pilules de base
- Flamme du cœur pour les élixirs intermédiaires
- Brasier de l'esprit pour les créations légendaires

**3. Compréhension des Cycles Cosmiques**
Le timing est crucial en alchimie. Chaque pilule doit être créée en harmonie avec :
- Les phases lunaires
- Les saisons
- Les alignements planétaires
- Les flux d'énergie terrestre

## Types de Pilules et Élixirs

### Pilules de Base (Rang Mortel)

**Pilule de Récupération Rapide**
- Ingrédients : Ginseng rouge, racine de guérison, miel spirituel
- Effet : Guérison accélérée des blessures mineures
- Durée de création : 3 heures

**Pilule de Force Temporaire**
- Ingrédients : Corne de taureau spirituel, herbe du tigre, essence de fer
- Effet : Augmentation de 50% de la force physique pendant 1 heure
- Durée de création : 6 heures

### Pilules Intermédiaires (Rang Spirituel)

**Pilule de Percée de Cultivation**
- Ingrédients : Fleur de lotus des neuf cieux, cristal d'énergie pure, larme de dragon
- Effet : Facilite la percée vers le niveau supérieur de cultivation
- Durée de création : 7 jours

**Élixir de Purification des Méridiens**
- Ingrédients : Eau de source sacrée, poudre d'os de saint, essence de vent
- Effet : Nettoie et élargit les canaux d'énergie
- Durée de création : 15 jours

### Pilules Avancées (Rang Céleste)

**Pilule de Longévité**
- Ingrédients : Fruit de l'immortalité, sang de phénix, essence temporelle
- Effet : Prolonge la vie de 100 ans
- Durée de création : 1 an

**Élixir de Transformation Divine**
- Ingrédients : Cœur de dragon ancien, larme d'immortel, quintessence cosmique
- Effet : Transformation temporaire en être semi-divin
- Durée de création : 10 ans

## Équipement et Laboratoire

### Le Fourneau Alchimique
Le cœur de tout laboratoire d'alchimie :
- **Fourneau de Bronze** : Pour les pilules de base
- **Fourneau d'Argent** : Pour les créations intermédiaires
- **Fourneau d'Or** : Pour les élixirs légendaires
- **Fourneau de Jade Céleste** : Réservé aux maîtres absolus

### Outils Essentiels
- Mortier et pilon en jade spirituel
- Balances de précision enchantées
- Fioles de cristal pur
- Instruments de mesure temporelle
- Cartes stellaires pour le timing

### Aménagement du Laboratoire
- Orientation selon les points cardinaux
- Isolation des énergies parasites
- Système de ventilation pour les vapeurs toxiques
- Zones de stockage climatisées
- Cercles de protection magique

## Techniques de Raffinage

### Méthode de la Fusion Harmonieuse
Technique de base consistant à mélanger les ingrédients dans l'ordre précis :
1. Préparation spirituelle de l'alchimiste
2. Purification des ingrédients
3. Fusion progressive sous feu contrôlé
4. Infusion d'énergie spirituelle
5. Cristallisation finale

### Technique des Neuf Transformations
Méthode avancée pour les pilules de haut rang :
- Chaque transformation purifie davantage la substance
- Nécessite un contrôle parfait du feu spirituel
- Risque d'explosion à chaque étape
- Seuls les maîtres expérimentés osent l'utiliser

### Art de la Sublimation Céleste
Technique suprême réservée aux légendes :
- Transformation de la matière en pure énergie
- Recristallisation selon les lois cosmiques
- Résultat : pilules aux effets quasi-miraculeux
- Taux de réussite inférieur à 1%

## Dangers et Précautions

### Risques pour l'Alchimiste
- Empoisonnement par les vapeurs toxiques
- Explosion du fourneau mal contrôlé
- Déviation du qi par surmenage
- Vieillissement prématuré dû aux expérimentations

### Effets Secondaires des Pilules
- Dépendance aux substances amélioratrices
- Déséquilibre énergétique temporaire
- Réactions allergiques aux ingrédients rares
- Interférences avec d'autres traitements

### Mesures de Sécurité
- Port d'équipements de protection
- Tests préalables sur de petites quantités
- Antidotes toujours à portée de main
- Assistance d'un partenaire expérimenté

## Écoles d'Alchimie Célèbres

### Secte du Fourneau Éternel
- Spécialisée dans les pilules de longévité
- Techniques transmises de maître à disciple unique
- Laboratoires secrets dans les montagnes

### Alliance des Cent Herbes
- Réseau de marchands et d'alchimistes
- Base de données complète des ingrédients
- Services de livraison dans tout le Murim

### Académie de l'Élixir Divin
- Institution d'enseignement officielle
- Recherche sur de nouvelles formules
- Certification des alchimistes professionnels

## Marché et Commerce

### Valeur des Pilules
- Pilule de base : 10-100 pièces d'or
- Pilule intermédiaire : 1,000-10,000 pièces d'or
- Pilule avancée : 100,000+ pièces d'or
- Élixir légendaire : Inestimable

### Réseaux de Distribution
- Marchands spécialisés dans les grandes villes
- Ventes aux enchères pour les pièces rares
- Troc direct entre alchimistes
- Commandes personnalisées pour les sectes

## Avenir de l'Alchimie

L'art de l'alchimie martiale continue d'évoluer :
- Découverte de nouveaux ingrédients
- Amélioration des techniques de raffinage
- Intégration de technologies modernes
- Recherche sur les effets à long terme

Pour les aspirants alchimistes, le chemin est long mais gratifiant. Maîtriser cet art ancestral demande des décennies d'étude, mais les récompenses - tant personnelles que pour la communauté martiale - en valent largement la peine.

Rappelez-vous : un véritable alchimiste ne cherche pas seulement à créer des pilules puissantes, mais à comprendre les mystères profonds de la vie et de l'énergie qui animent l'univers.",
                'author' => $user1,
                'category' => $categoryObjects[4] // Alchimie
            ]
        ];

        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->setTitle($articleData['title']);
            $article->setExcerpt($articleData['excerpt']);
            $article->setContent($articleData['content']);
            $article->setAuthor($articleData['author']);
            $article->setCategory($articleData['category']);
            $article->setPublished(true);
            $manager->persist($article);

            // Ajouter quelques commentaires
            for ($i = 0; $i < rand(1, 3); $i++) {
                $comment = new Comment();
                $comment->setContent($this->getRandomComment());
                $comment->setAuthor(rand(0, 1) ? $user1 : $user2);
                $comment->setArticle($article);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

    private function getRandomComment(): string
    {
        $comments = [
            "Excellent article ! Ces informations sont très précieuses pour ma cultivation.",
            "Merci pour ce partage de connaissances. J'ai appris beaucoup de choses nouvelles.",
            "Très intéressant, mais j'aurais aimé plus de détails sur les techniques avancées.",
            "Cet article m'a donné envie d'approfondir mes recherches sur ce sujet.",
            "Parfait pour les débutants comme moi. Explications claires et détaillées.",
            "J'ai une expérience différente sur ce point, mais votre approche est très valable.",
            "Merci de partager votre sagesse avec la communauté du Murim.",
            "Article fascinant ! Hâte de lire la suite de vos écrits."
        ];

        return $comments[array_rand($comments)];
    }
}