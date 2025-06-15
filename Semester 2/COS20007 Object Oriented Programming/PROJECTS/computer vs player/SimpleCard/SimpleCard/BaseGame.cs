using System;

namespace SimpleCard
{
    public class BaseGame
    {
        protected int numPlayers;
        protected List<Player> players;
        protected Deck deck;
        protected List<Card> cardsInPlay;

        public BaseGame(int numPlayers)
        {
            this.numPlayers = numPlayers;
            players = new List<Player>();
            deck = new Deck();
            cardsInPlay = new List<Card>();
        }
    }
}

// Marked as Protected because they are intended to be accessed from the derived classes.