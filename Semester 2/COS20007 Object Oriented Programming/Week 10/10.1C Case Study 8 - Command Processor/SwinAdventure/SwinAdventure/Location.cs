using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SwinAdventure
{
    public class Location : GameObject, IHaveInventory
    {
        //local variables
        private Inventory _inventory;
        private List<Path> _paths;

        //constructor
        public Location(string name, string desc) : base(new string[] { "house", "here" }, name, desc)
        {
            _inventory = new Inventory();
            _paths = new List<Path>();
        }

        //methods
        public GameObject Locate(string id)
        {
            if (AreYou(id))
            {
                return this;
            }

            Path foundPath = FindPath(id);
            if (foundPath != null)
            {
                return foundPath;
            }

            return _inventory.Fetch(id);
        }

        private Path FindPath(string id)
        {
            return _paths.FirstOrDefault(p => p.AreYou(id));
        }

        public void AddPath(Path path)
        {
            _paths.Add(path);
        }

        //properties
        public string PathList
        {
            get
            {
                if (_paths.Count == 0)
                {
                    return "There are no exits.";
                }

                List<string> pathNames = _paths.Select(p => p.Name).ToList();

                if (pathNames.Count == 1)
                {
                    return $"You can go to {pathNames[0]}.";
                }

                string lastPathName = pathNames.Last();
                string otherPathNames = string.Join(", ", pathNames.Take(pathNames.Count - 1));

                return $"You can go to {otherPathNames}, and {lastPathName}.";
            }
        }

        public override string FullDescription
        {
            get
            {
                return $"You are in {Name}\n{Description}\n{PathList}\nHere you can see:\n{_inventory.ItemList}";
            }
        }

        public Inventory Inventory
        {
            get
            {
                return _inventory;
            }
        }
    }
}