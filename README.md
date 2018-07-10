# Kulpable

Repository for Capstone Project

link to MSS's Google drive. (edit access so be careful - dont change anything)
https://drive.google.com/drive/folders/0B1MU7PF5fMMJbE5zTi1LbGxvU1k

What we need by Lsn 15 ish: 
One player goes at a time, while the other watches (receives updates). 
The main 'game' display is the map (one of the images from the drive->Game Administration->image files). 
Troops are dynamically displayed based on the data in the database. 
Players need to be able to 
    add troops to 'anywhere' on the board, 
    move troops from some cell to another cell on the board, limited by the troop's move stat, 
    and be able to remove troops from the board  
    ***(suggestion a side panel from which you can manage adding and deletion). 
We also need to have a safe close for the game.

To Do in list format:

-Display board
-Create sidepanel (optional design)
-display troops on board based on  database (done)
-Add troops to board
-Delete troops from board
-Move troops from cell to cell along board based on unit's move allowance.

(spencer's todo)
what the fuck will an admin do?
    (what does an admin need to do (teacher's needs))
        ideas
            -create game? (or just have the games already in there)
            -reset a game?
            -set parameters for a game
                -set the game state manually?
            -view a game in progress/saved
            -edit game info (team leads/points...other shit...)

use session variable to figure out red team or blue team (set up in the game_login_verify)
    then access the game in the database, it has a field for who's turn it is
        match these values up to determine if a player is allowed to make a turn
            possibly lock out moving or doing things if player is waiting for turn
                after submitting, javascript to lock out stuff (using ajax to wait for update in database)
                    after submitting a turn, set an update flag in the database for the other person to check
                        event_handler_2
                        
-sanitize comments and clean up code to be better than what jack fucking did

-mouse dragging hover over islands for popup and leave hover for
    only when mouse is dragging something (variable to keep track of it...)
    after 1 second-do the things
    if dragging out with an item on the mouse....wait 1 second and close the popup
    if mouse leaves without an item...don't close the popup...(unless default leaves map? (this functionality may change))

-figure out how logic of moving will work, what kinds of things need to happen with a side panel?
    sidepanel = adding troops and turn changes?
        perhaps a trashcan icon? (like drag things into it for deletion?)
        perhaps clicking a gamepiece will display info about it (or just text shown "selected: troops")
        figure out movement parameters for gameplay
            add logic for displaying remaining moves and have this update with each movement (if thats how it works)
            
-make sure turn based gameplay works
    add "locking out" mechanism and possibly another synch php to push out changes the other player makes? (after submitting)
        although....if they make changes, and the other refreshes...they will regrab the database...so maybe the placement needs more variables
            locked positionId, and newpositionId...and the submitting (after verifying moves) will update the locked ones in the database to what the new ones are
                and now the board updates based upon the locked position...so any updates don't become final until the submit occurs
