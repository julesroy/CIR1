#include <LiquidCrystal.h>
#define LED 8
#define LED_SECONDAIRE 9
#define BOUTON 3
LiquidCrystal lcd(15, 14, 4, 5, 6, 7);

bool waiting_mode; // Mode attente
bool obstacles_array[17]; // Liste contenant tous les obstacles visibles (16 + 1 pour le nouveau car il peut être partiellement affiché)
int position_y; // Définis la hauteur du joueur (0: ligne du haut, 1: entre les lignes, 2: ligne du bas)
int level;
int score;
int total_hover_duration; // Nombre de frames pendant lesquelles le personnage "flotte" (ne tombe pas si il a sauté trop tôt)
int hover_time; // Nombre de frames qu'il lui reste à flotter
bool is_jumping; // Variable qui vaut true si current_state vaut IS_JUMPING. Sert juste à éviter qu'une interruption puisse avoir lieu en plein milieu du code servant à gérer les sauts

int high_score;
int current_message; // Définis le message affiché sur l'écran d'accueil ("ISEN RUNNER" ou "PRESS TO START")
int level_display_time; // Variable qui détermine le nombre de frames restantes pendant lesquelles le niveau doit être affiché à la place du score

bool half_move; // si true tous les éléments sont décalés d'une demie-case ver la gauche
bool is_dead; // Définis si le joueur s'est pris un obstacle et est mort dans d'atroces souffrances
bool must_switch; // Définis si on doit changer de mode à la fin de la boucle

int previous_time; // Utilisé avec millis().
int current_time; // idem
enum possible_state
{
  IS_RUNNING,
  IS_JUMPING,
  IS_FALLING
}; // Définis l'état du joueur (0: Cours; 1: Saute; 2: Tombe)
possible_state current_state;

void switch_mode(bool wait_mode) // Fonction pour passer en mode attente (si true) ou en mode jeu (si false)
{
  lcd.clear();
  must_switch = false;
  current_time = 0;
  previous_time = -10000; // Défini à une valeur très basse pour que les événements qui ont lieu périodiquement aient également lieu lorsqu'on lance la boucle
  digitalWrite(LED, LOW);
  digitalWrite(LED_SECONDAIRE, LOW);
  if (wait_mode)
  {
    is_dead = false;
    waiting_mode = true;
    current_message = 0;
    lcd.setCursor(3, 1);
    lcd.print("HS: ");
    lcd.setCursor(7, 1);
    lcd.print(high_score);
    return;
  }
  else 
  {
    waiting_mode = false; // IMPORTANT : METTRE A TRUE LORS DU RENDU FINAL
    level = 5; // Le niveau du joueur qui change la vitesse
    total_hover_duration = 3;
    score = 0;
    position_y = 2;
    half_move = false;
    lcd.setCursor(2, 0);
    lcd.print("SCORE:");
    current_state = IS_RUNNING;
    for (int i = 0; i < 17; i++) obstacles_array[i] = 0; // La liste des obstacles, vide au début de la partie
  }
}

void interrupt(){
  if(waiting_mode){ // On lance une partie si on est dans le menu
    must_switch = true;
    return;
  }
  if (is_dead) // Si mort retourner au menu principal
  {
    must_switch = true;
    return;
  }
  if(position_y == 2 && current_state != IS_JUMPING){ // Si on est en jeu est sur le sol, on saute
    hover_time = total_hover_duration; 
    current_state = IS_JUMPING;
    if (obstacles_array[2] && half_move) score += 25; // Si le joueur saute au tout dernier moment il obtient un bonus de 25 points. Le fait de finir par 5 est volontaire : Ca permet de vérifier que le saut parfait a fonctionné
  }
}

void displayCharacter(int state){
  if (is_dead)
  {
    lcd.setCursor(0, 0);
    lcd.print(" ");
    lcd.setCursor(0, 1);
    lcd.write(5); // On affiche juste la tête, pour représenter l'effroyable violence dans laquelle le personnage est mort.
    return;
  }
  if (state == IS_RUNNING)
  {
    lcd.setCursor(0, position_y/2);
    if (half_move) lcd.write(3); // On défifnit la frame d'animation utilisée grâce à half_move 
    else lcd.write(2);
    return;
  }
  if (state == IS_JUMPING)
  {
    if (position_y == 1)
    {
      lcd.setCursor(0, 1);
      lcd.write(6);
      lcd.setCursor(0, 0);
      lcd.write(5);
    }
    else // position_y == 0
    {
      lcd.setCursor(0, 1);
      lcd.print(" "); // On supprime le caractère du bas une fois la ligne supérieure atteinte
      lcd.setCursor(0, 0);
      lcd.write(4);
    }
    return;
  }
  // state == IS_FALLING
  if (position_y == 1)
  {
    lcd.setCursor(0, 1);
    lcd.write(6);
    lcd.setCursor(0, 0);
    lcd.write(5);
  }
  else // Position_y == 2
  {
    lcd.setCursor(0, 1);
    lcd.write(4);
    lcd.setCursor(0, 0);
    lcd.print(" "); // On supprime le caractère du haut une fois la chute finie
  }
}

void displayScore()
{
  if (level_display_time == 1) // Si level_display_time vaut 1 cela signifie qu'on doit de nouveau afficher le score
  {
    lcd.setCursor(2, 0);
    lcd.print("SCORE:        ");
  }

  if (level_display_time <= 1) // On n'affiche le score que si on n'affiche pas déjà le niveau
  {
    int digit_number = 0; // Nombre de chiffres du score
    int temp_score = score;
    while (temp_score > 0) 
    {
      temp_score /= 10;
      digit_number++;
    }
    lcd.setCursor(15-digit_number, 0);
    lcd.print(score);
  }
}

void waiting_loop()
{
  current_time = millis();
  if (current_time - previous_time > 3000)
  {
    previous_time = millis();
    if (current_message == 1) current_message = 0;
    else current_message = 1;
    if (current_message == 0)
    {
      lcd.setCursor(1, 0);
      lcd.print("              "); //on efface la première ligne
      lcd.setCursor(2, 0); //placement du curseur
      lcd.print("ISEN RUNNER"); //nom jeu
    }
    else 
    {
      lcd.setCursor(2, 0);
      lcd.print("           "); //on efface la première ligne
      lcd.setCursor(1, 0); //placement du curseur
      lcd.print("PRESS TO START"); //instruction
    }
  }
  if (must_switch) {
    switch_mode(false);
    return;
  }
}

void game_loop()
{
  half_move = !half_move;
  //Partie décalage (on décale tous les obstacles vers la droite si half_move vaut false)
  if (!half_move) for (int i = 0; i < 16; i++) obstacles_array[i] = obstacles_array[i + 1];
  // Partie ajout d'obstacle
  bool new_obstacle = false; // Définit s'il y aura un obstacle supplémentaire
  int random_value = random(99); 
  if (obstacles_array[15] == 0) // Si il n'y a pas d'obstacle au bout
  {
    if (random_value < (15 + level*2)) new_obstacle = true; // Chance de nouvel obstacle augmente avec le niveau
    for (int i = 12 + level/5; i < 16; i++) // On laisse toujours au minimum 3 cases d'écart entre les obstacles (ou 4 quand la difficulté est basse) pour que le jeu reste possible
    {
      if (obstacles_array[i]) new_obstacle = false; // On désactive l'ajout d'obstacle si on en détecte un à la fin
    }
  }
  else // Si il y a un obstacle au bout (chances augmentées pour favoriser les obstacles longs)
  {
    if (random_value < (30 + level*3)) new_obstacle = true;
  }

  obstacles_array[16] = new_obstacle; // On ajoute un obstacle au bout, dans la case cachée

  // Partie affichage
  for (int i = 0; i < 16; i++)
  {
    lcd.setCursor(i, 1);
    if (half_move)
    {
      if (obstacles_array[i + 1] && obstacles_array[i]) lcd.write(8);
      else if (obstacles_array[i + 1]) lcd.write(7);
      else if (obstacles_array[i]) lcd.write(9);
      else lcd.print(" ");
    }
    else
    {
      if (obstacles_array[i]) lcd.write(8);
      else lcd.print(" ");
    }
  }

  // Partie détection d'obstacles (LED)
  bool led_is_lit = false;
  bool secondary_led_is_lit = false;
  if (position_y == 2) // Les LED ne s'allumeront pas si le personnage ne peut pas sauter
  {
    for (int i = 0; i < 2 + total_hover_duration; i++)
    {
      if (obstacles_array[1 + (half_move+i)/2])
      {
        led_is_lit = true;
        break;
      }
    }
    if (obstacles_array[2] && half_move) secondary_led_is_lit = true; // LED secondaire qui s'allume quand on est au dernier moment possible pour faire un saut, comme ça l'utilisateur sait exactement quand sauter pour avoir le bonus de saut précis
  }
  digitalWrite(LED, led_is_lit);
  digitalWrite(LED_SECONDAIRE, secondary_led_is_lit);


  // Partie personnage
  is_jumping = (current_state == IS_JUMPING); // Pour éviter qu'une interruption vienne changer cette valeur en plein milieu du bloc (on pourrait utiliser noInterrupts() mais ça gênerait l'utilisateur)
  if (position_y == 0) // tombe si il n'y a pas/plus d'obstacle dessous, cours sinon
  {
    if (obstacles_array[0] || (obstacles_array[1] && half_move)) current_state = IS_RUNNING;
    else 
    {
      if (is_jumping && hover_time > 0) hover_time--; // Si le personnage saute et il lui reste du temps de suspension, il ne tombe pas et son temps de suspension diminue
      else current_state = IS_FALLING; // Sinon (s'il n'a plus de temps ou s'il descendait d'une caisse) il tombe
    }
  } 
  if (current_state == IS_FALLING && position_y == 2) current_state = IS_RUNNING;
  if (is_jumping && position_y != 0) position_y--; // On doit vérifier que la position ne vaut pas 0 à cause du hover
  if (current_state == IS_FALLING) position_y++; // On réalise la chute avant de mettre à jour l'état pour éviter que le personnage n'atteigne le haut et ne tombe lors de la même frame
  
  // Partie mort 
  if (position_y != 0 && (obstacles_array[0] || (half_move && obstacles_array[1]))) is_dead = true; // Si le presonnage est sur la même positon qu'un obstacle sa vie prends fin dans des circonstances tragiquesr


  displayCharacter(current_state);
  score += 10;
  displayScore();

  // Partie gestion du niveau
  updateLevel();
  delay(200 + (9-level)*100);
}

void death_loop()
{
  lcd.setCursor(0, 0);
  lcd.print(" RIP IN PEACE  ");
  if (score > high_score) high_score = score;
  if (must_switch) {
    switch_mode(true);
    return;
  }
}

void updateLevel()
{
  if (level == 9) return; // On sort si le niveau est maximal car le reste du programme n'est plus utile
  int score_thresholds[9] = {0, 200, 500, 1000, 1500, 2000, 2500, 3000, 4000};
  if (score > score_thresholds[level]) // Si le score est supérieur au score nécéssaire pour augmenter de niveau
  {
    level++; // On augmente le niveau
    total_hover_duration = 3 - (level/4);
    level_display_time = 5;
    lcd.setCursor(2, 0);
    lcd.print("     LEVEL: ");
    lcd.print(level);
  }
}

void setup() {
  Serial.begin(9600); // Pour debuggage
  
  pinMode(LED, OUTPUT);
  pinMode(LED_SECONDAIRE, OUTPUT);
  digitalWrite(LED, LOW);
  digitalWrite(LED_SECONDAIRE, LOW);
  pinMode(BOUTON, INPUT_PULLUP); // !!! CHANGER CA A INPUT_PULLUP ET CELUI D'APRES A FALLING SUR LES UNO
  attachInterrupt(digitalPinToInterrupt(BOUTON), interrupt, FALLING);
  
  high_score = 0;

  lcd.begin(16,2);
  lcd.clear();
  randomSeed(analogRead(0)); // Initialisation du random
  switch_mode(true); // Au démarrage on est en mode attente

  byte perso1[8] ={
B01100,
B01100,
B00000,
B01110,
B11100,
B01100,
B11010,
B10011
};
lcd.createChar(2,perso1);
byte perso2[8] ={
B01100,
B01100,
B00000,
B01110,
B01100,
B01100,
B01100,
B01110
};
lcd.createChar(3,perso2);
byte perso3[8] ={
B01100,
B01100,
B00000,
B11110,
B01101,
B11111,
B10000,
B00000
};
lcd.createChar(4,perso3);
byte perso4tete[8] ={
B00000,
B00000,
B00000,
B00000,
B00000,
B01100,
B01100,
B00000
};
lcd.createChar(5,perso4tete);
byte perso4[8] ={
B11110,
B01101,
B11111,
B10000,
B00000,
B00000,
B00000,
B00000
};
lcd.createChar(6,perso4);
byte obs1[8] ={
B00011,
B00011,
B00011,
B00011,
B00011,
B00011,
B00011,
B00011
};
lcd.createChar(7,obs1);
byte obs2[8] ={
B11111,
B11111,
B11111,
B11111,
B11111,
B11111,
B11111,
B11111
};
lcd.createChar(8,obs2);
byte obs3[8] ={
B11000,
B11000,
B11000,
B11000,
B11000,
B11000,
B11000,
B11000
};
lcd.createChar(9,obs3);
}

void loop()
{
  if (waiting_mode) waiting_loop();
  else 
  {
    if (is_dead) death_loop();
    else game_loop();
  }
}


/* Système de mouvement (saut et chute):
 * Saut : on monte instantanément de 1 case (hauteur 1), la frame d'après on monte de 1 case (hauteur 0), la frame d'après on quitte le saut (chute ou course)
 * Chute : On descend instantanément de 1 case (hauteur 1), la frame d'après on descend d'1 case (hauteur 2)
 * A noter : on ne peut pas être en saut à la hauteur 2, ou en chute à la hauteur 0
 *
 *
 *
 */
