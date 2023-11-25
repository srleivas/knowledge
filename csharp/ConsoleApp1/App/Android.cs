namespace App;

public class App
{
    private string _name = "App";
    private string[] _installed = { "Facebook", "Reddit", "Github" };

    public string Name
    {
        get => _name;
        set { _name = value; }
    }

    public App(string appName)
    {
        if (!String.IsNullOrEmpty(appName))
        {
            Name = appName;
        }
        else
        {
            throw new ArgumentException("Invalid app name.");
        }
    }

    public bool Start()
    {
        bool appExists = Array.Exists(_installed, el => el.ToLower() == _name.ToLower());

        if (appExists)
        {
            return true;
        }

        return false;
    }
}

public class Android
{
    public void InitializeAndroid()
    {
        Console.WriteLine("Android initialized");
        string? appName = "";

        do
        {
            Console.WriteLine("Type in app name:");
            appName = Console.ReadLine();

        } while (String.IsNullOrEmpty(appName));

        App Application = new App(appName);

        if (Application.Start())
        {
            Console.WriteLine($"{Application.Name} started.");
        }
        else
        {
            Console.WriteLine($"{Application.Name} is not installed.");
        }
    }
}