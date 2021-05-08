
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

function printStar(n) {
  let result = ''
  for (let o = 1; o <= n; o++) {
    result += '*'
  }
  console.log(result)
}

function solve(lines) {
  for (let i = 1; i <= Number(lines); i++) {
    printStar(i)
  }
}
