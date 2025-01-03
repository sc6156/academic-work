import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

/**
 * A graphical representation of a cell in the Sokoban game which contains
 * a keylistener to track moves made by the user and implement them.
 *
 * @author Scott Cumming (ID 21056374)
 * @version March 2022
 */
public class GameCell extends JButton
{
    private SokobanGUI gameBoard;
    private int        row;
    private int        col;
    private ImageIcon  icon;

    private final String ACTOR         = "images/actor.png";
    private final String TARGET        = "images/target.png";
    private final String BOX           = "images/box.png";
    private final String WALL          = "images/wall.png";
    private final String TARGETACTOR   = "images/targetactor.png";
    private final String TARGETBOX     = "images/targetbox.png";

    /**
     * Construct an individual cell using a JButton and assign it an 
     * icon which graphically represents the matching cell in the GUI, 
     * adding a keylistener. 
     * 
     * @param board the GUI
     * @param row   the row in the game model
     * @param col   the column in the game model
     */
    public GameCell(SokobanGUI board, int row, int col)
    {
        if (board == null)
            throw new SokobanException("The GUI cannot be null");
        if (row < 0)
            throw new SokobanException("Row cannot be negative");
        if (col < 0)
            throw new SokobanException("Col cannot be negative");
            
        gameBoard = board;
        this.row = row;
        this.col = col;

        Cell match = gameBoard.getMatchingCell(this.row, this.col);
        char c = match.getDisplay();
        setCellIcon(c);

        setHorizontalAlignment(CENTER);
        setMargin(new Insets(0,0,0,0));

        addKeyListener(new KeyAdapter() {
                @Override
                public void keyPressed(KeyEvent e) {
                    int i = e.getKeyCode(); //Reference 
                    if (i == KeyEvent.VK_UP) {
                        Direction up = Direction.NORTH;
                        if(!board.possibleMove(up)) {
                            String options = gameBoard.getPossibleMoves();
                            gameBoard.setStatusBar("You cannot move in this direction! Please select one of the following options: " + options);
                        }
                        else {
                            board.move(up);
                        }
                    }

                    int j = e.getKeyCode(); //Reference 
                    if (j == KeyEvent.VK_DOWN) {
                        Direction down = Direction.SOUTH;
                        if(!board.possibleMove(down)) {
                            String options = gameBoard.getPossibleMoves();
                            gameBoard.setStatusBar("You cannot move in this direction! Please select one of the following options: " + options);
                        }
                        else {
                            board.move(down);
                        }
                    }

                    int k = e.getKeyCode(); //Reference 
                    if (k == KeyEvent.VK_LEFT) {
                        Direction left = Direction.WEST;
                        if(!board.possibleMove(left)) {
                            String options = gameBoard.getPossibleMoves();
                            gameBoard.setStatusBar("You cannot move in this direction! Please select one of the following options: " + options);
                        }
                        else {
                            board.move(left);
                        }
                    }

                    int l = e.getKeyCode(); //Reference 
                    if (l == KeyEvent.VK_RIGHT) {
                        Direction right = Direction.EAST;
                        if(!board.possibleMove(right)) {
                            String options = gameBoard.getPossibleMoves();
                            gameBoard.setStatusBar("You cannot move in this direction! Please select one of the following options: " + options);
                        }
                        else {
                            board.move(right);
                        }
                    }

                }
            });
    }

    /**
     * Set the icon of the GameCell.
     * 
     * @param c the char occupying the matching cell in the model.
     */
    void setCellIcon(char c) {
        if(c == Sokoban.TARGET) {
            this.setBackground(Color.WHITE);
            icon = new ImageIcon(TARGET);
            setIcon(icon);
        }
        else if(c == Sokoban.ACTOR) {
            this.setBackground(Color.WHITE);
            icon = new ImageIcon(ACTOR);
            setIcon(icon);
        }
        else if(c == Sokoban.BOX) {
            icon = new ImageIcon(BOX);
            setIcon(icon);
        }
        else if(c == Sokoban.WALL) {
            icon = new ImageIcon(WALL);
            setIcon(icon);
        }
        else if(c == Sokoban.TARGET_BOX) {
            icon = new ImageIcon(TARGETBOX);
            setIcon(icon);
        }    
        else if(c == Sokoban.TARGET_ACTOR) {
            this.setBackground(Color.WHITE);
            icon = new ImageIcon(TARGETACTOR);
            setIcon(icon);
        }
        else if(c == Sokoban.EMPTY) {
            this.setBackground(Color.WHITE);
            icon = new ImageIcon();
            setIcon(icon);
        }
        else {
            this.setBackground(Color.WHITE);
        }
    }
}