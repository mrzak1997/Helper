import { Injectable } from '@angular/core';
//import { IpcRenderer,IpcMain } from 'electron';
const electron=<any>window;
//const electron = (<any>window).require('electron');
@Injectable({
  providedIn: 'root'
})
export class IpcService {
  filter = ''
  constructor() {
    
  }
  
  send(s:string,arg: any[]){
    electron.ipcRenderer.send('resize-me-please',[350,525]);
  }
  

}

