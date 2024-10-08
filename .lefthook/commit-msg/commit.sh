#!/bin/zsh
# The script below adds the branch name automatically to
# every one of your commit messages. The regular expression
# below searches for JIRA issue key's. The issue key will
# be extracted out of your branch name
REGEX_ISSUE_ID="[a-zA-Z0-9,\.\_\-]+-[0-9]+"
NC='\033[0m'
BBlue='\033[1;34m'
BRed='\033[1;31m'
# Find current user email
USER_EMAIL=$(git config user.email)
# Verify if the user email is set to a devsquad email
if [[ "$USER_EMAIL" != *"devsquad.com" ]]; then
    echo -e "${BRed}You are not using a DevSquad email as your user.email... ${NC}"
    echo -e "${BBlue}You can use ${BRed}git config user.email \"type your devsquad email\"${BBlue} to set up the user.email.${NC}"
    exit 1
fi
# Find current branch name
BRANCH_NAME=$(git symbolic-ref --short HEAD)
# Extract issue id from branch name
ISSUE_ID=$(echo "$BRANCH_NAME" | grep -o -E "$REGEX_ISSUE_ID")
# Extract commit message
COMMIT_MESSAGE_FILE="$1"
if [ -z "$COMMIT_MESSAGE_FILE" ]; then
    echo -e "${BRed}Commit message file not found... ${NC}"
    exit 1
fi
COMMIT_MESSAGE=$(cat "$COMMIT_MESSAGE_FILE")
if [ -z "$ISSUE_ID" ]; then
    echo -e "${BRed}Branch doesn't have Jira task code on it... ${NC}"
    echo -e "${BBlue}Please, see the README file to learn what are the acceptable branch names.${NC}"
    exit 1
fi
# Prevent adding a JIRA issue key in commits that already have a JIRA issue key
# i.g. RA-1: RA-1: my feature
if [[ $COMMIT_MESSAGE == $ISSUE_ID* ]]; then
    exit 0
fi
echo "$ISSUE_ID: $COMMIT_MESSAGE" > "$COMMIT_MESSAGE_FILE"
