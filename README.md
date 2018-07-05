# Kulpable

Repository for Capstone Project

link to MSS's Google drive. (edit access so be careful - dont change anything)
https://drive.google.com/drive/folders/0B1MU7PF5fMMJbE5zTi1LbGxvU1k

What we need by Lsn 15 ish: Two players connect to the same game, saved in the database. One player goes at a time, while the other watches (receives updates). The main 'game' display is the map (one of the images from the drive->Game Administration->image files). Troops are dynamically displayed based on the data in the database. Players need to be able to add troops to [anywhere] on the board, move troops from some cell to another cell on the board, limited by the troop's move stat, and be able to remove troops from the board  (suggestion a side panel from which you can manage adding and deletion). We also need to have a safe close for the game.

To Do in list format:

-Display board
-Create sidepanel (optional design)
-display troops on board based on  database
-Add troops to board
-Delete troops from board
-Move troops from cell to cell along board based on unit's move allowance.

(spencer's todo)
use session variable to figure out red team or blue team (set up in the game_login_verify)
    then access the game in the database, it has a field for who's turn it is
        match these values up to determine if a player is allowed to make a turn
            possibly lock out moving or doing things if player is waiting for turn
                after submitting, javascript to lock out stuff (using ajax to wait for update in database)
                    after submitting a turn, set an update flag in the database for the other person to check
                        event_handler_2
-sanitize comments and clean up code to be better than what jack fucking did
