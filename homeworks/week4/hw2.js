
const request = require('request')
const process = require('process')

const args = process.argv
const APIweb = 'https://lidemy-book-store.herokuapp.com'

const execute = args[2]
const par1 = args[3]
const par2 = args[4]

if (execute === 'list') {
  listBooks()
} else if (execute === 'read') {
  readBook(par1)
} else if (execute === 'delete') {
  deleteBook(par1)
} else if (execute === 'create') {
  creatBook(par1)
} else if (execute === 'update') {
  updateBook(par1, par2)
} else {
  console.log('unknown execute')
}

function listBooks() {
  request(`${APIweb}/books?_limit=20`,
    (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }

      let books
      try {
        books = JSON.parse(body)
      } catch (error) {
        console.log(error)
        return
      }
      for (let i = 0; i < books.length; i++) {
        console.log(`${books[i].id} ${books[i].name}`)
      }
    })
}

function readBook(id) {
  request(`${APIweb}/books/${id}`,
    (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }
      console.log(body)
    })
}

function deleteBook(id) {
  request.delete(`${APIweb}/books/${id}`,
    (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }
      console.log(body)
    })
}

function creatBook(name) {
  request.post(`${APIweb}/books`,
    {
      form: {
        name
      }
    }, (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }
      console.log(body)
    })
}

function updateBook(id, newName) {
  request.patch(`${APIweb}/books/${id}`,
    {
      form: {
        name: newName
      }
    }, (error, response, body) => {
      if (error) {
        console.log('error', error)
        return
      }
      console.log(body)
    })
}
