using System;
using System.Numerics;

namespace SwinAdventure
{
	public class CommandProcessor : Command
	{
		List<Command> _commands;

		public CommandProcessor() : base(new string[] {"command"})
		{
            _commands = new List<Command>();
            _commands.Add(new LookCommand());
            _commands.Add(new MoveCommand());
		}

        public override string Execute(Player p, string[] text)
        {
            string input = text[0].ToLower();
            Command commandToExecute = null;
            // loop to find the most suitable command
            foreach (Command command in _commands)
            {
                if (command.AreYou(input))
                {
                    commandToExecute = command;
                    break;
                }
            }
            // if can't find the suitable command
            if (commandToExecute == null)
            {
                return "I don't know how to " + input + ".";
            }
            return commandToExecute.Execute(p, text);
        }
    }
}

