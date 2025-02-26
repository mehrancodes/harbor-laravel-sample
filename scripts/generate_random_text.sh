#!/usr/bin/env bash

# Array of words to choose from
WORDS=("cat" "dog" "banana" "moon" "sky" "code" "mountain" "car" "pizza" "phone" "house" "river" "tree" "galaxy" "fence")

function generate_random_sentence() {
  # Choose a random number of words (between 3 and 8 for example)
  local length=$((RANDOM % 6 + 3))
  local sentence=""

  for i in $(seq 1 $length); do
    # Pick a random word from the array
    local word=${WORDS[$((RANDOM % ${#WORDS[@]}))]}

    # Capitalize the first word only
    if [[ $i -eq 1 ]]; then
      word="$(tr '[:lower:]' '[:upper:]' <<< "${word:0:1}")${word:1}"
    fi

    # Append the word to the sentence
    sentence+="${word} "
  done

  # Trim the trailing space and add a period at the end
  sentence="$(echo "$sentence" | sed 's/[[:space:]]$//')."
  echo "$sentence"
}

# Generate a random sentence
RANDOM_SENTENCE=$(generate_random_sentence)

# File to write to
OUTPUT_FILE="random_text.txt"

# Make sure the file exists (creates if it doesn’t)
touch "$OUTPUT_FILE"

# Append the new random sentence to a new line
echo "$RANDOM_SENTENCE" >> "$OUTPUT_FILE"

echo "Random sentence added to $OUTPUT_FILE:"
echo "$RANDOM_SENTENCE"
