﻿namespace SwinAdventure
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            string name;
            string desc;
            Player player;

            Console.WriteLine("Welcome to SwinAdventure!\n");

            // PLayer Descriptions
            Console.WriteLine("Enter Player Name:");
            name = Console.ReadLine();

            Console.WriteLine("Enter Player Description:");
            desc = Console.ReadLine();

            player = new Player(name, desc);

            // Setting items and inventory
            Item sword = new Item(new string[] { "Sword" }, "a golden sword", "This is a golden sword");
            Item knife = new Item(new string[] { "Knife" }, "a sharp knife", "This is a sharp knife");
            Item gem = new Item(new string[] { "Diamond" }, "a valuable gem", "This is an expensive item");

            Bag bag = new Bag(new string[] { "Bag" }, "big bag", "This is a big bag");

            player.Inventory.Put(sword);
            player.Inventory.Put(knife);
            player.Inventory.Put(bag);
            bag.Inventory.Put(gem);

            // Setting up items in location
            Item skull = new Item(new string[] { "skull" }, "a skull", "This is a creepy skull");
            Item torch = new Item(new string[] { "torch" }, "a torch", "This is a bright red torch");
            Item charm = new Item(new string[] { "charm" }, "a charm", "This is a lucky charm");
            Item shield = new Item(new string[] { "shield" }, "a shield", "This is a strong shield");


            // Setting up location
            Location jungle = new Location("a jungle", "This is a scary jungle");
            Location tower = new Location("a tower", "This is a tilted tower");
            Location forest = new Location("a forest", "This is a wet forest");

            Path jungleSouth = new Path(new string[] { "south", "s" }, "South", "South Path", tower);
            jungle.AddPath(jungleSouth);
            Path towerEast = new Path(new string[] { "east", "e" }, "East", "East Path", forest);
            jungle.AddPath(towerEast);
            Path forestNorth = new Path(new string[] { "north", "n" }, "North", "North Path", jungle);
            forest.AddPath(forestNorth);

            jungle.Inventory.Put(skull);
            tower.Inventory.Put(shield);
            tower.Inventory.Put(torch);
            forest.Inventory.Put(charm);

            player.Location = jungle;

            // Command 
            while (true)
            {
                Console.WriteLine("\nCommand: ");
                string input = Console.ReadLine();
                if (!string.IsNullOrEmpty(input))
                {
                    string[] execommand = input.ToLower().Split(' ');
                    if (execommand[0] == "quit")
                    {
                        break;
                    }
                    else
                    {
                        Console.WriteLine(new CommandProcessor().Execute(player, execommand));
                    }
                }
                
            }
        }
    }
}