namespace SimpleCard
{
    public enum Suit
    {
        Hearts,
        Diamonds,
        Clubs,
        Spades
    }

    public enum Rank
    {
        Ace = 1,
        Two,
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
        King
    }

    public class Card
    {
        public Rank Rank { get; }
        public Suit Suit { get; }
        public int Value { get; }

        public Card(Rank rank, Suit suit)
        {
            Rank = rank;
            Suit = suit;
            Value = GetValue();
        }

        public int GetValue()
        {
            if (Rank == Rank.Ace)
            {
                // Return 11 if the total hand value is less than or equal to 10, otherwise return 1.
                return (Value <= 10) ? 11 : 1;
            }
            else
            {
                // Return the corresponding value for other ranks.
                return (int)Rank;
            }
        }

        public override string ToString()
        {
            return $"{Rank} of {Suit}";
        }
    }
}
