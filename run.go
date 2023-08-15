package main

import (
	"bufio"
	"fmt"
	"os"
	"os/exec"
	"strconv"
	"strings"
	"sync"
)

func main() {
	readline := func(cmd string, lower bool) string {
		fmt.Print(cmd)
		reader := bufio.NewReader(os.Stdin)
		text, _ := reader.ReadString('\n')
		text = fmt.Sprintf("%v", text)
		res := strings.ReplaceAll(text, "\n", "")
		if lower {
			res = strings.ToLower(res)
		}
		return res
	}
	sess, _ := strconv.Atoi(readline("Session Amount : ", false))
	loop, _ := strconv.Atoi(readline("Loop/session Amount : ", false))
	cmd := readline("Command : ", false)
	var wg sync.WaitGroup
	fmt.Println("Running Bot....")
	for a := 1; a <= sess; a++ {
		for i := 1; i <= loop; i++ {
			wg.Add(1)
			go running(cmd, &wg)
		}
		wg.Wait()
	}
}

func running(command string, wg *sync.WaitGroup) string {
	defer wg.Done()
	cmd1 := strings.Split(command, " ")
	cmd := exec.Command(cmd1[0], cmd1[1], cmd1[2])
	output, _ := cmd.Output()
	result := string(output)
	fmt.Print(result)
	return result
}
