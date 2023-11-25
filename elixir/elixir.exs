normalizeString = fn string -> String.upcase(string) |> String.trim_leading("0") end

cleanString = normalizeString.("000Teste_n_0023")

IO.puts(cleanString)

{a, b, c} = {:theAtom, "Hey", 25}

IO.puts("Arg1: #{a}, Arg2: #{b}, Arg3: #{c}\n")

[head | _tail] = ["head", "torso", "tail"]

IO.puts(head)

case {1, 2, 3} do
  "AH" ->
    IO.puts("AH")

  {1, x, 3} when x > 0 ->
    IO.puts("Matched: #{x}")

  _ ->
    "Match _ !"
end

eleven = 11

cond do
  1 + eleven == 11 ->
    false

  hd([1, eleven]) == eleven ->
    IO.puts(tl([eleven, "hMatch\n"]))

  eleven == 11 ->
    IO.puts("Eleven\n")

  true ->
    IO.puts("True\n")
end

isFact = true

if isFact do
  IO.puts("IS FACTUAL!")
else
  IO.puts("NOT A FACT!")
end

speech = 67

unless speech > 80 or (isFact and speech > 60) do
  IO.puts("Say that to the guards!")
end
