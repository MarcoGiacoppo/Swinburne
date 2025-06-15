using System;

namespace SimpleCard
{
    public class Dealer
    {
        private readonly Deck _deck;

        public Dealer(Deck deck)
        {
            _deck = deck;
        }

        public Card GetCard()
        {
            return _deck.TakeTopCard();
        }
    }

}

