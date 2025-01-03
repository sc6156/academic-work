import java.io.*;
import java.util.*;

/**
 * A text-based user interface for a Sokoban puzzle.
 * 
 * @author Dr Mark C. Sinclair, modified by Scott Cumming (ID 21056374)
 * @version March 2022
 */
public class SokobanUI {
    private static String FILENAME = "screens/screen.";
    private static final String SAVEDGAME = "savedgame.txt";
    private static int level;

    private Scanner scnr                = null;
    private Sokoban puzzle              = null;
    private Player  player              = null;
    private Stack<Direction> gameMoves  = null;

    private static boolean   traceOn = false; // for debugging
    /**
     * Default constructor
     */
    public SokobanUI() {
        level = 1;
        scnr   = new Scanner(System.in);
        puzzle = new Sokoban(new File(FILENAME + level));
        player = new RandomPlayer();
        gameMoves = new Stack<Direction>();
    }

    /**
     * Main control loop.  This displays the puzzle, then enters a loop displaying a menu,
     * getting the user command, executing the command, displaying the puzzle and checking
     * if further moves are possible
     */
    public void menu() {
        String command = "";
        System.out.print(puzzle);
        while (!command.equalsIgnoreCase("Quit") && !puzzle.onTarget())  {
            displayMenu();
            command = getCommand();
            execute(command);
            System.out.print(puzzle);
            if (puzzle.onTarget())
                System.out.println("puzzle is complete");
            trace("onTarget: "+puzzle.numOnTarget());
        }
    }

    /**
     * Display the user menu
     */
    private void displayMenu()  {
        System.out.println("Commands are:");
        System.out.println("   Move North         [N]");
        System.out.println("   Move South         [S]");
        System.out.println("   Move East          [E]");
        System.out.println("   Move West          [W]");
        System.out.println("   Player move        [P]");
        System.out.println("   Undo move          [U]");
        System.out.println("   Restart puzzle [Clear]");
        System.out.println("   Save to file    [Save]");
        System.out.println("   Load from file  [Load]");
        System.out.println("   To end program  [Quit]");    
    }

    /**
     * Get the user command
     * 
     * @return the user command string
     */
    private String getCommand() {
        System.out.print ("Enter command: ");
        return scnr.nextLine();
    }

    /**
     * Execute the user command string
     * 
     * @param command the user command string
     */
    private void execute(String command) {
        if (command.equalsIgnoreCase("Quit")) {
            System.out.println("Program closing down");
            System.exit(0);
        } else if (command.equalsIgnoreCase("N")) {
            north();
        } else if (command.equalsIgnoreCase("S")) {
            south();
        } else if (command.equalsIgnoreCase("E")) {
            east();
        } else if (command.equalsIgnoreCase("W")) {
            west();
        } else if (command.equalsIgnoreCase("P")) {
            playerMove();
        } else if (command.equalsIgnoreCase("U")) {
            undo();
        } else if (command.equalsIgnoreCase("Clear")) {
            clear();
        } else if (command.equalsIgnoreCase("Save")) {
            save();
        } else if (command.equalsIgnoreCase("Load")) {
            load();
        } else {
            System.out.println("Unknown command (" + command + ")");
        }
    }

    /**
     * Move the actor north
     */
    private void north() {
        move(Direction.NORTH);
    }

    /**
     * Move the actor south
     */
    private void south() {
        move(Direction.SOUTH);
    }

    /**
     * Move the actor east
     */
    private void east() {
        move(Direction.EAST);
    }

    /**
     * Move the actor west
     */
    private void west() {
        move(Direction.WEST);
    }

    /**
     * Move the actor according to the computer player's choice
     */
    private void playerMove() {
        Vector<Direction> choices = puzzle.canMove();
        Direction         choice  = player.move(choices);
        move(choice);
    }  

    /**
     * If it is safe, move the actor to the next cell in a given direction
     * 
     * @param dir the direction to move
     */
    private void move(Direction dir) {
        if (!puzzle.canMove(dir)) {
            System.out.println("invalid move");
            return;
        }
        puzzle.move(dir);
        gameMoves.push(dir);
        if (puzzle.onTarget()) {
            int nextLevel = level + 1; 
            if(level < 90) {
                System.out.println("Level " + level + " completed. Start of level " + nextLevel + ".");
                level++;
                gameMoves.clear();
                puzzle = new Sokoban(new File(FILENAME + level));
                menu();
            }
            if(level == 90) {
                System.out.println("Congratulations! You have completed the game and all 90 levels!");
            }
        }
    }

    public static void main(String[] args) {
        SokobanUI ui = new SokobanUI();
        ui.menu();
    }

    /**
     * A trace method for debugging (active when traceOn is true)
     * 
     * @param s the string to output
     */
    public static void trace(String s) {
        if (traceOn)
            System.out.println("trace: " + s);
    }

    /**
     * Enables the user to undo their last move.
     */
    public void undo() {
        if(gameMoves == null)
            throw new SokobanException("The Stack of moves cannot be null. ");
        else if(!gameMoves.empty()) {
            gameMoves.pop();
            Stack<Direction> oldGameMoves = gameMoves;
            clear();
            for (Direction move: oldGameMoves) {
                puzzle.move(move);
                gameMoves.push(move);
            }
        }
        else {
            System.out.println("Cannot undo the last move as no moves have been made.");
        }
    }

     /**
     * Restarts the current level of the game.
     */
    public void clear() {
        puzzle.clear();
        gameMoves = new Stack<Direction>();
    } 

    /**
     * Save the game in its current state to a text file.
     */
    public void save() {
        FileManager.save(new File(SAVEDGAME), level, gameMoves); 
        System.out.println("Game saved to file.");
    }

    /**
     * Load the saved game from the text file.
     */
    public void load() {
        File file = new File(SAVEDGAME);
        if(file.length() == 0) {
            System.out.println("Cannot load game as file is empty.");
            return;
        }
        ArrayList<Direction> savedMoves = FileManager.load(new File(SAVEDGAME));
        level = FileManager.getLevel();
        gameMoves.clear();
        puzzle = new Sokoban(new File(FILENAME + level));
        for(Direction dir: savedMoves) {
            puzzle.move(dir);
            gameMoves.push(dir);  
        }
        menu();
        System.out.println("Game loaded from file.");
    }
}