const request = require('request')

const CLIENT_ID = '5x1cqevn8waw0s5nysjmuza35ntb9k'
const BASE_URL = 'https://api.twitch.tv/kraken'

request.get({
  url: `${BASE_URL}/games/top`,
  headers: {
    'Client-ID': CLIENT_ID,
    Accept: 'application/vnd.twitchtv.v5+json'
  }
}, (error, response, body) => {
  if (error) {
    console.log('error', error)
    return
  }

  try {
        info = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }

  const data = info.top
  for (let i = 0; i < data.length; i++) {
    console.log(`${data[i].viewers} ${data[i].game.name}`)
  }
})
