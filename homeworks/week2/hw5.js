function join(arr, concatStr) {
    var ns = ""
    for (var i = 1; i < arr.length; i += 2){
        arr.splice(i, 0, concatStr)
    }
    for (var m = 0; m <= arr.length-1; m++){
        ns += (arr[m])
        } return ns
} 


function repeat(str, times) {
    var ns = ""
    for (var i = 0; i <= times; i++){
        ns = ns + str
    } return ns

}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));



