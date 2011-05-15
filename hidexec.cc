#if 0 // To compile with VC, type "nmake hidexec.cc", copied from zipmix
hidexec.exe: hidexec.cc
	cl hidexec.cc shell32.lib user32.lib /Ox /GA /MD /arch:SSE2 /EHsc
	if exist hidexec.exe.manifest mt.exe /manifest hidexec.exe.manifest /outputresource:hidexec.exe;1
	if exist hidexec.obj del hidexec.obj
	if exist hidexec.exe.manifest del hidexec.exe.manifest
!if 0
#endif

#include <iostream>
#include <cstring>
#include <windows.h>
#include <stdarg.h>
#define argc __argc
#define argv __argv
using namespace std;

void help (char *name);

int WINAPI WinMain (HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow) {
	string cmd;
	string arg = "";
	bool wait;

	if (argc == 1) {
		help (argv[0]);
		return 0;
	}

	if (argc < 2 || (argv[1] != "/w" && argv[1] != "-w")) {
		cmd = argv[1];
		for (int i = 1; i < argc; i++)
			arg += argv[i];
		wait = true;
	} else {
		cmd = argv[2];
		for (int i = 2; i < argc; i++)
			arg += argv[i];
		wait = false;
	}

	SHELLEXECUTEINFO ShExecInfo = {0};
	ShExecInfo.cbSize = sizeof(SHELLEXECUTEINFO);
	ShExecInfo.fMask = SEE_MASK_NOCLOSEPROCESS;
	ShExecInfo.hwnd = NULL;
	ShExecInfo.lpVerb = NULL;
	ShExecInfo.lpFile = cmd.c_str();		
	ShExecInfo.lpParameters = arg.c_str();	
	ShExecInfo.lpDirectory = NULL;
	ShExecInfo.nShow = SW_HIDE;
	ShExecInfo.hInstApp = NULL;	
	ShellExecuteEx(&ShExecInfo);

	if (wait)
		WaitForSingleObject(ShExecInfo.hProcess, INFINITE);

	return 0;
}

void help (char* name) {
	char text[500];
	sprintf(text, "SoftX Window Hider\r\n\
Purpose: Execute a program in the background,\r\n\
         optionally wait for it to terminate\r\n\
\r\n\
Usage: %s [/w|/h] <program> [args]\r\n\
\r\n\
    /w  Wait for the program to terminate\r\n\
    /h  Display this text", name);
	MessageBox(NULL, text, "Help - SoftX Window Hider", MB_ICONINFORMATION);
}

#if 0
!endif
#endif