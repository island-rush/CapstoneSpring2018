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

What has been done (in a functional sense, not fully implemented (like with all pieces...etc)):
    add troops to board button
    move troops around board to each spot
    delete troops from board
    undo last movement button
    red/blue teams must both login to start game
    admin page with minimal functionality
    game auto saves (for now....)

To Do in list format:

-Display board
-Create sidepanel (optional design) (working on it)
-display troops on board based on  database (done)
-Add troops to board (functionality done)
-Delete troops from board (functionality done)
-Move troops from cell to cell along board based on unit's move allowance.

(spencer's todo)
CLICK A PIECE TO SEE VALID MOVES WITH HIGHLIGHTED SHADING?

what the fuck will an admin do?
    (what does an admin need to do (teacher's needs))
        ideas
            -create game? (or just have the games already in there)
                -SPENC: setup a game and insert all of the Game parameters so it can be played
            -reset a game?
            -set parameters for a game
                -SPENC: Change the list of newsflash events (lategame)
            -view a game in progress/saved
            -edit game info (team leads/points...other shit...)

use session variable to figure out red team or blue team (set up in the game_login_verify)
    then access the game in the database, it has a field for who's turn it is
        match these values up to determine if a player is allowed to make a turn
            possibly lock out moving or doing things if player is waiting for turn
                after submitting, javascript to lock out stuff (using ajax to wait for update in database)
                    after submitting a turn, set an update flag in the database for the other person to check
                        event_handler_2
                        
-sanitize comments and clean up code to be better than what jack fucking did - lol

DONE-mouse dragging hover over islands for popup and leave hover for
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

-add temp and confirmed placements...or add table called 'movements' that are added to...
    either thing works (but may need to consider backwards (undo) movements?)
        unless there is an undo button (which would have to access a previous movement)
            confirmed using new table of movements... (and keep track of turn?) (only undo what was in this turn?)
    -need to add turns to the game table and include these in the movements
        if only undo movements in current phase, turn++ on every phase
        if undo movements in any phase, turn++ on every change of team's turn
            this may be harder and unlikely, may have any phase completion be final
                otherwise, need to keep track of the phase as well in movements
                    as well as tracking the phase changes to 'undo' them to get back into them
                        you can see why this is not ideal                  
    -undo mechanics, only dealing with current phase
        -clear the movements after phase is done?
            -may make things slightly easier
        -don't clear movements, keep adding to it only with updated turns/phases
            -little more complex, but adds future capability to replay the game (admin feature?)      
        -delete a movement after undoing it is a must       
        -things are still displayed from the placements database, and movements only use temp positions (which become final if no undo)
        -only make a movement after it is valid from javascript checks (adj matrix/unit moves...etc)
        
-possibly remove positions table in sql entirely (not used yet)
    -only uses could be for game logic (if the current position is water...if the current position is land...)
    
-change formatting in sql file to match everywhere (not sometimes `` and without....all or none)

-possibly generate the board with php, because of how redundant each element is
    only differences between ocean blocks is positionId?
    DO THIS ABSOLUTELY LAST (changing/adding elements is a bitch within php echo statements)
    ONLY do this for readability ('clean code') of main gameboard?...should not affect performance (may even decrease it)
    
-high latency may become a problem with some of the game functionality, but won't know until most of game is done.
    look into improving some of the 'http' requests / ajax stuff, network latency probably worst offender

Sidepanel
--------------------------------------------------------------
NOTES ABOUT SIDE PANEL (during call between spencer and jack)
    display purchasing cash / points (infinite for now)
    panel for choosing what to buy (click and buy)
    empty box for storing what was bought
        -position 118 adjacent to everything that is a valid drop
            -check for the individual piece type's valid drops using JScript
        -pieces in 'bought' box cant be moved onto board
            -pieces can be deleted from bought box to refund cost
        -drag and drop pieces from here onto the board (check all things were placed?)
            -once the player confirms they are done buying (and it's the place-bought-troops phase), 
             the delete is locked and the map opens for moving into. All troops must be moved onto map
    buttons for saving game/exiting game (these possibly in an upper nav bar? drop down menu?)
    buttons for going to next phase (lategame stuff)
    display for what phase a player is on (still lategame but good to add an area for this now)
    buttons for other stuff player does during phases... 
        -(we could copy code and have diff pages for diff phases and just change the sidepanel for whats relevant)


notes about changing placement table to store currentMoves about a piece
    need to change update_move php (subtract the moves from current piece)
    need to change movement_undo php (look up how far a move is and add that to the piece's moves)
    need to change the display_pieces php to use the currentMove, not the unitMove (can't refresh for more moves hack)
    for reset->
    need to create a JSON object at top of script to store each units default (max) moves
        or just (yet) another php file to access the database
            this drawback is 1 access at beginning of game vs multiple access (at end of each phase)
                probably not terrible, since phases last a long time...but if it just happens once while loading that would be ideal
                
                
Transport
-------------------------------------------------
NOTES ABOUT TRANSPORT (during call between spencer and jack) + other thoughts about how to solve it
    piece in piece
    transport stays on water
    popup like the special_islands (fill in a single grid? (easy to graphically put from div of parent grid?))
    new attribute in placement table, transportId = placementId foreign key (default null or 0?)
    special rules in the drop, check if unit is a transport, then do extra steps to also move stuff?
        extra step = change positions of troops in the transport to match the transport?
    to prevent refresh hacking
        check if transportid not null, and if its not null, don't display it? (put in popup? somehow...)
    dynamically create the popup? (it changes position?)
    same functionality as other special_islands with dragging over to make pop, and dragging off to erase?
    need to find best way to dynamically show/move them in and out...
        have hidden divs at the bottom?
        each transport piece gets created with a div inside it? (this would be easy in the display pieces php/place newpiece)
    movements also need special attention not to break
        moving troops in and out of transports (how to tell that this happened for undo mechanics?)
    still check adj matrix for troops entering transport from far away
    maybe good way of solving is to write step by step the logic of each transport mechanic
        -create a transport (display / newpiece)
            on both php files, add check for unitName, if transport add onclick, ondragenter, ...etc (whatever is needed)
                this can happen inside the already formed piece echo div... (or possibly more than 1 echo works just as well...)
            for display, need extra check to see what is inside of it? (database check) and then add those pieces to inside the div
            for create, don't need to add anything to the inside of it (unless theres an extra 'block' or 'container' that we put for the pieces)
        -move a transport (only water tile? - may need this functionality for other pieces)
            checks need to happen (with database) to make sure the position it moves to is a water block (or starting block)
            some same actions occur, (check if moving it also moves its children (it should in theory))
            update the position in database, as well as its children's positions in database
                this happens inside update position?
                how to undo the movement of a transport with things inside of it
                undo still has the piece, still knows both positions
                    needs to grab any pieces with that transportId and change their positions as well (extra step)
                movements stay the same (transport piece is only one that moves* for a movement insert)
                    this way only 1 movement insertion for all the pieces to move together (keeps track cause still attached)
                        what about moving into and out of a ship
                            movement may need before transportId and after transportId (amphibious vehicles?)
                                but this may not be a problem, since we can assert that whatever it carries can't be in the water
                                    but still problem of which transport was it in (2 transports same position)
                                        movement will need the transportId before and after (or just before, after = placement table already (also not needed))
        -move troop into a transport
            need to figure out graphically how to display dynamically moving popups (even if it fits within the gridblock)
                although may be good to keep the gridblock size because it will look better (ships are small / islands are big (have lots of stuff))
                    (island has multiple positions with multiple pieces in each...transport has 3 max inside the single position)
                drag troops into the parent div of the parent (parent will have ondrop (special ondrop?))
                    the ondrop will change their transportId, as well as appendChild to parent (transport)
                    more functions to make the popup appear / disappear (onclick to show? like islands) (hoverstart may be able to be used again in the same way)
                        probably don't have to worry about user interaction being worse with dragging and hovering on a piece size smaller than the gridblock (test this first/last?)
                            if hover doesn't work, can always click to make pop
                                hide_all needs to now include the transport popups (so clicking anywhere will clear the board (keep that functionality at all times))
                potentially no new php files, all can be special catches inside already built php files (but need to take not of what will break / what gets used when changes are implemented)
                    (most bugs come from forgetting to change database calls, or other calls being made not directly to this, but using same tables...)
                adjacency matrix should not need to change (still need to travel 1 space to enter the transport) (not a free move)
                dragging them into the popup (that then can be hidden or shown...)
                    possibly need to have a container div inside the parent transport (that way all pieces rely on 1 div)
                        could be an easy way to display it with css magic, give it a special class
                            but still need dynamically move it around with the transport
                                first figure out how to put the div inside, (display it), and have it have gridblock css, not gamepiece css
                                    if this can happen, it solve the graphical problems...
                                        everything else is hidden around it when poped, so don't worry about other ships's divs in the same position
        -move transport with troops inside it
            movement is just for the transport, but now has beforeTransportId (for other gamepieces to move in and out)...but this will always be null/default for transport ships themselves
            update position is (fingers crossed) only updating the transport shit, (it has the divs and pieces as children of itself...which hopefully follows it around)
            before this, regular checking (javascript) if legal moves (add checks for position = water) and dist[][]
            move the parent normally (like the other stuff) html wise..
        -move troops out of a transport
            movement will update the positions, and update the transport id to null (beforeTransportId) (it will store the new one in the placement table)
                (note to update the placement table
        -accessing the transport's insides/storing what is inside of it?
            onclick to make the popup (done)
            possibly use the same hover over methods
            hideall needs to include it (done)
-----------------------
major changes that effect lots of shit for transport
    update placements table for transportId
        many php files use this (creating, displaying, moving, ....maybe list them all to make sure I change them correctly the first time))
            starting to get too complex to find all errors with quick testing
    update movements table for beforeTransportId
        undo movements may need special attention (html moving things back into the child container div)
        inserting the movement
        also updating positions of the troops inside the transport
            check if UnitName = transport...then do extra steps (loop through the children) (can get children with database calls)


More random thoughts moving forward
    with more restrictions comes less bugs/glitches/unwanted events
        such as
            making sure all pieces placed before moving to next phase
            making sure player cant trash pieces if not the right phase (purchasing)
            making sure player cant move other team's pieces (more checks on it)
            all of these can maybe go into the checkvalid.php (cause already checking movement)
            but maybe disable grabbing / selecting if not the right phase? (first check in the php files could be for right phase/turn...etc)
                or enable grabbing but it doesn't actually move (like same what happens with outside valid moves)
            can't trash transport with things inside because that would never happen
            can't move enemy troops cause not allowed
            can't move transport onto land cause that isn't allowed (checks in the position table?)
                NEED TO RIGHT DOWN ALL OF THESE LITTLE RULES
                    and find the best places to enforce them in the code
    
            
    
    