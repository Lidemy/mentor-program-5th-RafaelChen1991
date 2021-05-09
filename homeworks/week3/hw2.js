
const readline = require('readline')

const rl = readline.createInterface({
  input: process.stdin
})

const lines = []
rl.on('line', (line) => {
  lines.push(line)
})

rl.on('close', () => {
  solve(lines)
})

function narNumber(n) {
  const firstLength = n.toString().length
  let result = 0
  for (let i = firstLength - 1; i >= 0; i--) {
    result += Math.pow(parseInt(n / Math.pow(10, i)), firstLength)
    n -= (parseInt(n / Math.pow(10, i))) * Math.pow(10, i)
  }
  return result
}

function numCheck(n) {
  if (Number(n) === narNumber(n)) {
    console.log(narNumber(n))
  }
}

function solve(lines) {
  const temp = lines[0].split(' ')
  const a = Number(temp[0])
  const b = Number(temp[1])
  for (let i = a; i <= b; i++) {
    numCheck(i)
  }
}
