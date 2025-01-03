import java.io.*;
import java.util.*;

/**
 * Utility class which provides file handling functionality to both the 
 * Sokoban GUI and text-based UI. Contains methods for writing a game to a 
 * text file and reading a game from a text file. 
 *
 * @author  Scott Cumming (ID 21056374)
 * @version March 2022
 */
public class FileManager
{
    private static int level = 0;

    /**
     * Saves the current level of the game and the moves made in 
     * that level in a text file.
     */
    public static void save(File file, int gameLevel, Stack<Direction> moves)
    {
        try {
            PrintStream savedGame = new PrintStream(file);
            savedGame.println(gameLevel);
            for (Direction move : moves)
                savedGame.println(move);
            savedGame.close();
        }
        catch(IOException e) {
            return;  
        }
    }

    /**
     * Reads moves from a text file using a scanner and returns them in an
     * ArrayList. Also reads the level of the game from the file and stores
     * this in a class variable.
     * 
     * @return ArrayList containing moves linked to the saved level.
     */
    public static ArrayList<Direction> load(File file)
    {
        try {
            if(file == null) {
                throw new SokobanException("File cannot be null");
            }
            if(file.length() == 0) {
                throw new SokobanException("File cannot be empty");
            }
            if(!file.getName().toLowerCase().endsWith(".txt")) {
                throw new SokobanException("File is not a text file");
            }
            ArrayList<Direction> recallMoves = new ArrayList<>(); 
            Scanner loadGame = new Scanner(file);
            level = Integer.parseInt(loadGame.nextLine());
            while(loadGame.hasNextLine()) {
                String line = loadGame.nextLine();
                recallMoves.add(Direction.fromString(line));
            }
            loadGame.close();
            return recallMoves;
        } catch (IOException e) {
            return null;
        } 
    }

    /**
     * Gets the level of the game loaded from a text file.
     * 
     * @return the level of the game loaded from file.
     */
    public static int getLevel()
    {
        return level;
    }
}
