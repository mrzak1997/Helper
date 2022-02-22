import { Component, OnInit } from '@angular/core';
//const electron = (<any>window)
const electron = (<any>window).require('electron');
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  
  constructor() {
    electron.ipcRenderer.send('resize-me-please',[355,525]);
   }

  ngOnInit(): void {
  }

}
