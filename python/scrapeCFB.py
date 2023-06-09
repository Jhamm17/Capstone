import requests
from bs4 import BeautifulSoup
from datetime import datetime
import mysql.connector

# Set the URL for the website to scrape
url = 'https://www.sports-reference.com/cfb/'

# Make a request to the website and get the HTML content
response = requests.get(url)

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(response.content, 'html.parser')

# Get the current date and format it as 'YYYY-MM-DD'
today = datetime.now().strftime('%Y-%m-%d')

# Find all the game scores on the page
scores = soup.find_all('div', {'class': 'game_summary nohover'})


# Define the MySQL configuration
mysql_config = {
    'host': 'db.luddy.indiana.edu',
    'user': 'i494f22_team36',
    'password': 'my+sql=i494f22_team36',
    'database': 'i494f22_team36'
}

# Connect to the MySQL database
cnx = mysql.connector.connect(**mysql_config)
cursor = cnx.cursor()

# Delete all data from the iulive1 table
cursor.execute('DELETE FROM iulive1')

# Loop through each game and extract the required data
for game in scores:

    GameDate = today

    # Get the top and bottom scores of the game
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    
    # Get the team names
    Team1Name = game.find_all('a')[0].text.strip()
    Team2Name = game.find_all('a')[2].text.strip()

    # Set the Sport value as "CFB"
    Sport = "CFB"
    GameYesterday = "Y"

    # Check for null values in the extracted data and update GameYesterday to 'N' if any of the values are null
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"

    # Insert the extracted data into the iulive1 table
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

    # Print the extracted data
    print('GameDate:', GameDate)
    print('GameScore:', GameScore)
    print('Team1Name:', Team1Name)
    print('Team2Name:', Team2Name)
    print('Sport:', Sport)
    print('GameYesterday:', GameYesterday)

# Close the MySQL connection
cursor.close()
cnx.close()
