function join(arr, concatStr) {
    var newStr = ""
    for (var i = 1; i < arr.length; i += 2){
        arr.splice(i, 0, concatStr)
    }
    for (var m = 0; m <= arr.length-1; m++){
        newStr += (arr[m])
    } return newStr
} 


function repeat(str, times) {
    var newStr = ""
    for (var i = 0; i <= times; i++){
        newStr = newStr + str
    } return newStr

}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
