namespace App;

public class MathLab
{
    public List<int> getFibonacciSequence(int limit = 45)
    {
        limit = limit > 45 ? 45 : limit;

        List<int> fibonacciSequence = new List<int> { 1, 1 };

        int precedingNumber1 = 0;
        int precedingNumber2 = 0;

        for (int i = fibonacciSequence.Count; i <= limit; i++)
        {
            precedingNumber1 = fibonacciSequence[i - 1];
            precedingNumber2 = fibonacciSequence[i - 2];

            fibonacciSequence.Add(precedingNumber1 + precedingNumber2);
        }

        return fibonacciSequence;
    }
}
