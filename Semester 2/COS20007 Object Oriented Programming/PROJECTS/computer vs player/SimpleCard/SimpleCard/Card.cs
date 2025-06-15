namespace SimpleCard;

    public class Card
    {
        public Rank Rank { get; }
        public Suit Suit { get; }

        public Card(Rank rank, Suit suit)
        {
            Rank = rank;
            Suit = suit;
        }

        public override string ToString()
        {
            return $"{Rank} of {Suit}";
        }

        public int CompareTo(Card other)
        {
            if (Rank == other.Rank)
            {
                return Suit.CompareTo(other.Suit);
            }
            return Rank.CompareTo(other.Rank);
        }
    }

    public enum Rank
    {
        Two = 2,
        Three,
        Four,
        Five,
        Six,
        Seven,
        Eight,
        Nine,
        Ten,
        Jack,
        Queen,
        King,
        Ace
    }

    public enum Suit
    {
        Spades = 3,
        Hearts = 2,
        Clubs = 1,
        Diamonds = 0
    }