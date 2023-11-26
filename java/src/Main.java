import static java.lang.Thread.sleep;

public class Main {
    public static void main(String[] args) throws InterruptedException {
        iwannago(600);
    }

    public static void iwannago(int howMuchYouWannaGo) throws InterruptedException {
        int ino = 1;
        short ahCcummulated = 0;

        while (ino <= howMuchYouWannaGo) {
            if (ahCcummulated < 3) {
                System.out.println("AH");
                ahCcummulated++;
            } else {
                ahCcummulated = 0;
                System.out.println("Wana go o o");

                dorme(600);
                System.out.println("All the uueee e e ");

                dorme(600);
                System.out.println("Taking out ma freak toni i ight");
            }

            ino++;
            dorme(600);
        }
    }

    public static void dorme(int time) throws InterruptedException {
        try {
            sleep(time);
        } catch (InterruptedException e) {
            throw new InterruptedException(e.getMessage());
        }
    }
}