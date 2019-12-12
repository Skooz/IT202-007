using UnityEngine;
using System.Collections;

public class ClickTimes : MonoBehaviour
{
    // Reference: https://gamedevelopment.tutsplus.com/tutorials/how-to-code-a-self-hosted-phpsql-leaderboard-for-your-game--gamedev-11627

    public GameObject counter;      //This counts down.
    public GameObject toptext;      //This is the text at the top. We can also identify it by name, which we'll show later!
    private bool allowedToClick;    //Whether the player has control
    private bool firstClick;        //Whether the player has clicked at all yet.

    void Start()
    {
        //For every text object
        foreach (GUIText text in FindObjectsOfType(typeof(GUIText)) as GUIText[])
        {
            if (text != GetComponent<GUIText>()) text.fontSize = Mathf.FloorToInt(Screen.height * 0.08f); // If it isn't attached to this object (i.e. our central text) we set it to this size
            else text.fontSize = Mathf.FloorToInt(Screen.height * 0.18f); //For our central text, we set it to this size.
        }

        //Initialize our variables.
        allowedToClick = true;
        firstClick = false;
    }

    //Our function to count down
    IEnumerator Countdown()
    {
        yield return new WaitForSeconds(1); //Wait for one second.

        //It's more sensible to store this as an integer, but let's explore some string manipulation.
        //We'll make the new text equal to the old number with 1 subtracted.
        counter.GetComponent<GUIText>().text = (System.Int32.Parse(counter.GetComponent<GUIText>().text) - 1).ToString();  
        
        //If we haven't hit 0, keep going
        if (counter.GetComponent<GUIText>().text != "0")
        {
            StartCoroutine(Countdown());
        }
        else
        {
            //Otherwise the player can't click anymore
            allowedToClick = false;
            GetComponent<HighScore>().Setscore(System.Int32.Parse(GetComponent<GUIText>().text)); // Send our score through to our HighScore class
            foreach (GUIText text in FindObjectsOfType(typeof(GUIText)) as GUIText[])
            {
                text.enabled = false; //We disable all our text
            }
            GetComponent<HighScore>().enabled = true; // And we turn on the highscore class
        }
    }

    // Update is called once per frame
    void Update()
    {
        if (allowedToClick && Input.GetMouseButtonUp(0)) // If the user is allowed to click and chooses to
        {
            if (!firstClick) // If they haven't clicked yet, the countdown starts.
            {
                firstClick = true;
                StartCoroutine(Countdown());
            }
            GetComponent<GUIText>().text = (System.Int32.Parse(GetComponent<GUIText>().text) + 1).ToString(); //And the score goes up.
        }
    }
}