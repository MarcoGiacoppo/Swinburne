using System;
using System.Collections.Generic;

namespace SimpleCard
{
    public class Deck
    {
        private List<Card> _cards;
        private int _numDecks;

        public Deck(int numDecks = 1)
        {
            _numDecks = numDecks;
            Reset();
        }

        public int NumCards
        {
            get { return _cards.Count; }
        }

        public void Shuffle()
        {
            Random rng = new Random();
            int n = _cards.Count;
            while (n > 1)
            {
                n--;
                int k = rng.Next(n + 1);
                Card temp = _cards[k];
                _cards[k] = _cards[n];
                _cards[n] = temp;
            }
        }

        public Card Draw()
        {
            if (_cards.Count == 0)
            {
                throw new InvalidOperationException("The deck is empty.");
            }

            Card card = _cards[0];
            _cards.RemoveAt(0);
            return card;
        }

        public void Reset()
        {
            _cards = new List<Card>();
            for (int i = 0; i < _numDecks; i++)
            {
                for (int j = 1; j <= 13; j++)
                {
                    Rank rank = (Rank)j;
                    _cards.Add(new Card(rank, Suit.Hearts));
                    _cards.Add(new Card(rank, Suit.Diamonds));
                    _cards.Add(new Card(rank, Suit.Clubs));
                    _cards.Add(new Card(rank, Suit.Spades));
                }
            }
        }
    }
}
