
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

function isPrime(n) {
  const num = Number(n)
  if (num === 1) {
    return false
  } else {
    for (let i = 2; i < num; i++) {
      if (num % i === 0) {
        return false
      }
    } return true
  }
}

function solve(lines) {
  for (let i = 1; i < lines.length; i++) {
    if (isPrime(lines[i]) === false) {
      console.log('Composite')
    } else {
      console.log('Prime')
    }
  }
}
