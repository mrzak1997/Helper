const {app, BrowserWindow,ipcMain} = require('electron')

    const url = require("url");
    const path = require("path");

    let mainWindow

    function createWindow () {
      mainWindow = new BrowserWindow({
        width: 355,
        height: 525,
        title: 'trader helper',
        resizable: false,
        webPreferences: {
          nodeIntegration: true,
          contextIsolation: false
        }
      })
      
      /*mainWindow.loadURL(
        url.format({
          pathname: path.join(__dirname, `/dist/angular-build/index.html`),
          protocol: "file:",
          slashes: true
        })
      );*/
      mainWindow.loadURL('http://localhost:4200/');
      // Open the DevTools.
      mainWindow.webContents.openDevTools()
      mainWindow.setMenu(null)
      mainWindow.on('closed', function () {
        mainWindow = null
      })
    }

    app.on('ready', createWindow)

    app.on('window-all-closed', function () {
      if (process.platform !== 'darwin') app.quit()
    })
    
    app.on('activate', function () {
      if (mainWindow === null) createWindow()
    })

    ipcMain.on('resize-me-please', (event, arg) => {
      
      mainWindow.setSize(arg[0],arg[1]);
    })