
const request = require('request')
const process = require('process')

const args = process.argv
const APIweb = 'https://restcountries.eu/rest/v2/name'

function main() {
  const country = args[2]
  if (!country) {
    return console.log('請輸入國家名稱')
  }
  request.get(
    `${APIweb}/${country}?fields=name;capital;currencies;callingCodes`,
    (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }

      let data
      try {
        data = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }

      if (response.statusCode === 404) {
        console.log('找不到國家資訊')
      } else {
        for (let i = 0; i < data.length; i++) {
          console.log('============')
          console.log(`國家 : ${data[i].name}`)
          console.log(`首都 : ${data[i].capital}`)
          console.log(`貨幣 : ${data[i].currencies[0].code}`)
          console.log(`國碼 : ${data[i].callingCodes[0]}`)
        }
      }
    }
  )
}

main()
