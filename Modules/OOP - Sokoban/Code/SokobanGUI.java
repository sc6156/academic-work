import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.util.*;
import java.io.*;
import javax.swing.BorderFactory;
import javax.swing.border.Border;
import javax.swing.Timer;
import javax.swing.filechooser.*;

/**
 * A Graphical User Interface (GUI) for the Sokoban puzzle game.
 *
 * @author Scott Cumming (ID 21056374)
 * @version March 2022
 */
public class SokobanGUI implements Observer
{
    private static String FILENAME = "screens/screen.";
    private static int level;

    private Sokoban          game       = null;
    private GameCell[][]     cells      = null;
    private Stack<Direction> gameMoves  = null;
    private int              rows;
    private int              cols;
    private File             file       = null;

    private JFrame frame         = null;
    private JPanel gameBoard     = null;
    private JTextField statusBar = null;

    /**
     * Default constructor.
     */
    public SokobanGUI()
    {    
        level = 1;
        gameMoves = new Stack<>(); 
        loadLevel();
    }

    /**
     * Creates the Sokoban game and the JFrame containing the GUI components
     * for a given level. 
     */
    private void loadLevel()
    {
        //Initiate the game model.
        game = new Sokoban(new File(FILENAME + level));
        game.addObserver(this);
        rows = game.getNumRows();
        cols = game.getNumCols();

        //Create the JFrame with 3 main components - a menu bar, gameboard (JPanel) and status bar.
        if(file == null)
            frame = new JFrame("Sokoban   -   Level " + level + "   -   New Game"); 
        else
            frame = new JFrame("Sokoban   -   Level " + level + "   -   " + file.getName().toString()); 
        Container contentPane = frame.getContentPane();
        createMenuBar();
        createGameBoard();
        contentPane.add(gameBoard,BorderLayout.CENTER);
        Border gameBoardBorder = BorderFactory.createEmptyBorder(64-(rows*4),400-(cols*cols),64-(rows*4),400-(cols*cols));
        gameBoard.setBorder(gameBoardBorder);
        statusBar = new JTextField();
        statusBar.setEditable(false);
        contentPane.add(statusBar,BorderLayout.SOUTH);

        //Adjust JFrame settings. 
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        frame.pack();
        frame.setVisible(true);
    }

    /**
     * Populates the menu bar with items and adds actionlisteners 
     * to each one. 
     */
    private void createMenuBar()
    {
        JMenuBar menuBar = new JMenuBar();
        frame.setJMenuBar(menuBar);

        JMenu fileMenu = new JMenu("File");
        menuBar.add(fileMenu);

        JMenuItem resetLevel = new JMenuItem("Reset Level");
        fileMenu.add(resetLevel);
        resetLevel.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    clear();
                }
            });

        JMenuItem undoMove = new JMenuItem("Undo Last Move");
        fileMenu.add(undoMove);
        undoMove.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    undo();
                }
            });

        JMenuItem loadGame = new JMenuItem("Open");
        fileMenu.add(loadGame);
        loadGame.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    load();
                }
            });

        JMenuItem saveGame = new JMenuItem("Save As");
        fileMenu.add(saveGame);
        saveGame.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    saveAs();
                }
            });

        JMenuItem newSave = new JMenuItem("Save");
        fileMenu.add(newSave);
        newSave.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    save();
                }
            });

        JMenuItem exit = new JMenuItem("Exit");
        fileMenu.add(exit);
        exit.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    int sg = JOptionPane.showConfirmDialog(frame,"Do you want to save your game before exiting?", "Save game?", JOptionPane.YES_NO_CANCEL_OPTION); 
                    if(sg == JOptionPane.YES_OPTION) {   
                        save();
                        exit();
                    }
                    if(sg == JOptionPane.NO_OPTION) {   
                        exit();
                    }
                }
            });

        JMenu aboutMenu = new JMenu("Help");
        menuBar.add(aboutMenu);

        JMenuItem guide = new JMenuItem("How to Play");
        aboutMenu.add(guide);
        guide.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent ae) {
                    createPopUp();
                }
            });         
    }

    /**
     * Creates a JPanel in Gridlayout to represent the Sokoban board and 
     * assigns a GameCell object to each cell.
     */
    private void createGameBoard()
    {
        int row, col;
        gameBoard = new JPanel(new GridLayout(rows, cols));
        cells = new GameCell[rows][cols];
        for (row=0; row<rows; row++) {
            for (col=0; col<cols; col++) {
                cells[row][col] = new GameCell(this, row, col);
                gameBoard.add(cells[row][col]);
            }
        }
    }

    /**
     * Gets the cell in the Sokoban model that corresponds to the cell
     * in the gameboard.
     * 
     * @param r the row number of a cell in the gameboard.
     * @param c the column number of a cell in the gameboard.
     * @return the matching cell in the Sokoban model.
     */
    Cell getMatchingCell(int r, int c)
    {
        return game.getCell(r, c);
    }

    /**
     * Moves the actor to a valid cell and loads the next level if
     * the move completes the current level.
     * 
     * @param dir the direction to move the actor.
     */
    void move(Direction dir) { 
        game.move(dir);
        gameMoves.push(dir);
        if (game.onTarget()) {
            int nextLevel = level + 1;   
            if(level < 90) {
                int ok = JOptionPane.showConfirmDialog(frame,
                        "Congratulations, you have completed level " + level + ". Click OK to start level " + nextLevel + ".", "Level Completed",
                        JOptionPane.DEFAULT_OPTION, JOptionPane.PLAIN_MESSAGE);

                if(ok == JOptionPane.OK_OPTION) {    
                    level++; 
                    JFrame oldFrame = frame; 
                    loadLevel();
                    gameMoves.clear(); //Better than creating a new stack each time using resources
                    oldFrame.dispose(); //Reference API
                }
            }
        }
        if(level == 90 && game.onTarget()) {
            JOptionPane.showMessageDialog(frame,
                "Congratulations! You have completed the game and all 90 levels!",
                "Winner!",
                JOptionPane.PLAIN_MESSAGE); 
        }
    }

    /**
     * Checks whether a move is valid.
     * 
     * @param d the direction to be checked. 
     * @return a boolean value stating whether the move is valid.
     */
    boolean possibleMove(Direction d)
    {
        return game.canMove(d);
    }

    /**
     * Checks where the actor can move to next.
     * 
     * @return all possible directions in a String. 
     */
    String getPossibleMoves()
    {
        Vector<Direction> dirs = new Vector<>();
        for (Direction dir : Direction.values()) {
            if (game.canMove(dir)) 
                dirs.add(dir);
        }
        String options = dirs.toString();
        String options1 = options.replaceAll("NORTH", "UP");
        String options2 = options1.replaceAll("SOUTH", "DOWN");
        String options3 = options2.replaceAll("EAST", "RIGHT");
        String options4 = options3.replaceAll("WEST", "LEFT");
        return options4;
    }

    /**
     * Updates the GameCells in the gameboard when the matching cells in 
     * the Sokoban model change.
     * 
     * @param o the observable. 
     * @param arg the cell in the model which changed.  
     */
    @Override
    public void update(Observable o, Object arg)
    {
        if(arg == null)
            throw new SokobanException("arg (Cell) is null");
        if(arg instanceof Cell) {
            Cell change = (Cell) arg;
            int row = change.getRow();
            int col = change.getCol();
            char symbol = change.getDisplay();
            cells[row][col].setCellIcon(symbol);
        }
    }

    /**
     * Adds a given string to the status bar for 3 seconds.
     * 
     * @param s the text to be added to the status bar. 
     */
    void setStatusBar(String s) 
    {
        if(s instanceof String) {
            statusBar.setText(s);
            Timer t = new Timer(3000, new ActionListener() {

                        @Override
                        public void actionPerformed(ActionEvent e) {
                            statusBar.setText("");
                        }
                    });
            t.setRepeats(false);
            t.start();
        }
        else {
            throw new SokobanException("Non-string cannot be entered into the status bar");
        }
    }

    /**
     * Resets the game to the start of the level.
     */
    void clear()
    {
        game.clear();
        gameMoves = new Stack<Direction>(); 
    }

    /**
     * Undoes the last move made by the user.
     */
    void undo()
    {
        if(gameMoves.empty()) {
            setStatusBar("You cannot undo the last move as no moves have been made!");
            return;
        }
        else {
            gameMoves.pop();
            Stack<Direction> oldGameMoves = gameMoves;
            clear();
            for (Direction move: oldGameMoves) {
                game.move(move);
                gameMoves.push(move);
            }
        }
    }

    /**
     * Saves the current game to a new text file created by the user.
     */
    private void saveAs()
    {
        JFileChooser newSave = new JFileChooser(FileSystemView.getFileSystemView().getHomeDirectory());
        newSave.setDialogTitle("Save As");
        int ns = newSave.showSaveDialog(frame);
        if(ns == JFileChooser.APPROVE_OPTION) {
            file = newSave.getSelectedFile();
            if(!file.getName().toLowerCase().endsWith(".txt")) {
                file = new File(file.getParentFile(), file.getName() + ".txt"); 
            }
            save();
            frame.setTitle("Sokoban   -   Level " + level + "   -   " + file.getName().toString()); 
        }   
    }

    /**
     * Saves the current game to the text file already created.
     */
    private void save()
    {
        if(file == null) 
            saveAs();
        else {
            FileManager.save(file, level, gameMoves);
            setStatusBar("The game has been saved");
        }
    }

    /**
     * Loads a saved game from a text file selected by the user. 
     */
    private void load()
    {
        JFileChooser newLoad = new JFileChooser(FileSystemView.getFileSystemView().getHomeDirectory());
        newLoad.addChoosableFileFilter(new FileNameExtensionFilter("*.txt", "txt"));
        newLoad.setDialogTitle("Load");
        int nl = newLoad.showOpenDialog(frame);
        if(nl == JFileChooser.APPROVE_OPTION) {
            file = newLoad.getSelectedFile();
            if(file == null) {
                setStatusBar("Could not load game from file.");
                return;
            }
            if(!file.getName().toLowerCase().endsWith(".txt")) {
                setStatusBar("Could not load game as file selected is not a text file.");
                return;
            }
            if(file.length() == 0) {
                setStatusBar("Could not load the game as the text file is empty.");
                return;
            }
            ArrayList<Direction> savedMoves = FileManager.load(file);
            if((FileManager.getLevel() <= 0) || (FileManager.getLevel() > 90)) {
                setStatusBar("Could not load the game as the text file is in the wrong format.");
                return;
            }
            level = FileManager.getLevel();
            clear();
            JFrame oldFrame = frame; 
            loadLevel();
            for(Direction dir: savedMoves) {
                move(dir);    
            }
            setStatusBar("Game loaded from file");
            oldFrame.dispose();
        } 
    }

    /**
     *  Creates a popup with instructions on how to play the game, 
     *  which can be accessed from a menu item.
     */
    private void createPopUp()
    {
        JDialog instructions = new JDialog(frame, "How to play Sokoban");
        instructions.setSize(700, 400);
        instructions.setLocationRelativeTo(null); 
        instructions.setVisible(true);

        JTextArea text = new JTextArea();
        instructions.add(text, BorderLayout.CENTER);
        text.setLineWrap(true);
        text.setWrapStyleWord(true);
        Font font = new Font("Arial", Font.BOLD, 16);
        text.setFont(font);
        text.append("The aim of the game is to push all the boxes in the puzzle to the target squares using the player.\n\n");
        text.append("You can move the player up, down, left and right by using the arrow keys on the keyboard.\n\n");
        text.append("Walls surround a Sokoban puzzle and form part of the layout. You cannot make the player walk through a wall.\n\n");
        text.append("You also cannot push two boxes together towards a target.\n\n");
        text.append("The game protects you from making moves which you cannot recover from.\n\n");
        text.append("If you try to make an illegal move, the status bar at the bottom of screen will notify you of which directions you can move the player in.\n\n");
        text.append("There are 90 levels in the game.\n\n");
        text.append("Good luck!");
        text.setVisible(true);
    }

    /**
     * Closes the game and the application. 
     */
    private void exit()
    {
        System.exit(0);
    }

    /**
     * Gets the total number of rows in the current level of the game.
     * 
     * @return the number of rows in the game model.
     */
    public int getRows()
    {
        return rows;
    }

    /**
     * Gets the total number of columns in the current level of the game.
     * 
     * @return the number of columns in the game model.
     */
    public int getCols()
    {
        return cols;
    }
}