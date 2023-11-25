using System;
using App;

public class Program
{
    static void Main()
    {
        //Android phone = new App.Android();
        //phone.InitializeAndroid();

        MathLab mathLab = new App.MathLab();
        List<int> fibonacciSequence = mathLab.getFibonacciSequence();

        fibonacciSequence.ForEach(number => Console.WriteLine(number));
    }
}