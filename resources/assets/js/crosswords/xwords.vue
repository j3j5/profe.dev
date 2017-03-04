<template>
    <div class="crossword">
        <div id="puzzle_container">
            <table id="puzzle">
                <tr v-for="row in matrix">
                    <td v-for="column in row" class="square empty">{{column.toString()}}</td>
                </tr>
            </table
        </div>

        <div id="hints_container">
            <h3>Vertical</h3>
                <div id="vertical_hints_container"></div>
            <h3>Horizontal</h3>
                <div id="horizontal_hints_container"></div>
        </div>

        <div id="buttons_container">
            <button id="clear_all">Clear All</button>
            <button id="check">Check</button>
            <button id="solve">Solve</button>
            <button id="clue">Clue</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Xwords",

    props: [
        'width', 'height', 'words', 'answers', 'clues'
    ],

    data: function() {
        return {
            matrix: [],
            wordsInHorizontal: 0,
            wordsInVertical: 0,
        };
    },

    computed: {
        horizontal: function() {
            return Math.round(this.answers.length/2);
        },
        vertical: function() {
            return this.answers.length - this.horizontal;
        },
    },

    created: function() {
        this.initializeMatrix();

        this.placeWords();
    },

    methods: {
        initializeMatrix: function() {
            for (var row = 0; row < this.height; row++) {
                if (!this.matrix[row]) {
                    this.matrix.push(new Array());
                }
                for (var column = 0; column < this.width; column++) {
                    if (!this.matrix[row][column]) {
                        this.matrix[row].push(new Array());
                    }
                }
            }
        },

        placeWords: function() {
            var that = this;
            this.answers.forEach( function(word){
                // Fill first horizontals
                var spot;
                if (that.wordsInHorizontal < that.horizontal) {
                    spot = that.findSpotForHorizontalWord(word);
                    that.addHorizontalWord(word, spot.startRow, spot.startColumn);
                    that.wordsInHorizontal++;
                } else {
                    spot = that.findSpotForVerticalWord(word);
                    that.addVerticalWord(word, spot.startRow, spot.startColumn);
                    that.wordsInVertical++;
                }
            });
        },

        /**
         * Given a word, find a horizontal spot on the matrix for it
         * and return its coordinates.
         *
         * TODO: Try different methods, maybe first even rows and then odd ones?
         */
        findSpotForHorizontalWord: function(word) {
            var start = this.getRandomInt(0, this.height);
            console.log('horiz start ' + start);
            var end = this.height + start;


            for (var rowi = start; rowi < this.height; rowi++) {
                for (var columni = 0; columni < this.width; columni++) {
                    // Implement the circular loop
                    var row = rowi,
                        column= columni;
                    if (rowi >= this.height) {
                        row = rowi - this.height;
                    }
                    if (columni >= this.width) {
                        column = columni - this.width;
                    }

                    if (this.matrix[row][column].length == 0 && this.wordFitsRow(word, column, row)) {
                        // row is empty, add the word
                        return {startRow: row, startColumn: column};
                    }
                }
            }
            return {startRow: -1, startColumn: -1};
        },
        /**
         * Given the word and the starting coordinates, add the word to
         * the matrix horizontally
         */
        addHorizontalWord: function(word, row, column) {
            for (var index = 0; index < word.length; index++) {
                this.matrix[row][index+column] = word[index];
                // Add space to split words
                if (index == word.length -1) {
                    this.matrix[row][index+column+1] = " ";
                }
            }
        },

        /**
         * Does the word fits into a row given its starting coordinates?
         */
        wordFitsRow: function (word, startColumn, row) {
            // console.log("Checking if word " + word + " fits on column " + startColumn + ' starting at row ' + row);
            return word.length < this.matrix[row].length - startColumn;
        },

        /**
         * Find a spot on a column that can fit the given word vertically.
         *
         * TODO: Try different methods, maybe first even columns and then odd ones?
         */
        findSpotForVerticalWord: function(word) {
            var start = this.getRandomInt(0, this.height);
            console.log('vert start ' + start);
            var end = this.height + start;

            for (var columni = 0; columni < this.width; columni++) {
                for (var rowi = 0; rowi < this.height; rowi++) {
                    // Implement the circular loop
                    var row = rowi,
                        column= columni;
                    if (rowi >= this.height) {
                        row = rowi - this.height;
                    }
                    if (columni >= this.width) {
                        column = columni - this.width;
                    }

                    var rowToUse = row;
                    if (this.matrix[rowToUse][column].length == 0 && this.wordFitsColumn(word, rowToUse, column)) {
                        // Leave an empty space if there's already a letter on the column
                        if (rowToUse > 0 && rowToUse < this.height - 2) {
                            rowToUse = row + 1;
                        }
                        return {startRow: rowToUse, startColumn: column};
                    }
                }
            }
            return {startRow: -1, startColumn: -1};
        },

        /**
         *
         */
        addVerticalWord: function(word, row, column) {
            for (var index = 0; index < word.length; index++) {
                this.matrix[index+row][column] = word[index];
                // Add space to split words
                if (index == word.length-1 && index+row+1 < this.height) {
                    this.matrix[index+row+1][index] = " ";
                }
            }
        },

        /**
         *
         */
        wordFitsColumn: function(word, startRow, column) {
            var columnSpace = 0;
            startRow++;
            // console.log("Checking if word " + word + " fits on column " + column + ' starting at row ' + startRow);
            for(var row=startRow; row<this.height; row++) {
                if (this.matrix[row][column].length == 0) {
                    columnSpace++;
                } else {
                    // Finish the loop.
                    break;
                }
            }
            return columnSpace >= word.length;
        },

        fillAnswer: function (question_number){

        },

        clearAnswer: function (question_number){

        },

        checkAnswer: function (question_number){

        },

        showClue: function (question_number,i,j){

        },
    },
}
</script>

<style>
.empty {
    background-color: white;
}

.square {
    width: 30px;
    height: 30px;
    margin: 0;
    padding: 0;
    border-collapse: collapse;
    position: relative;
}
</style>
