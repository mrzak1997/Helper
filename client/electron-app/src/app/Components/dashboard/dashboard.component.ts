import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  menu_item = ['منو','منو','منو','منو','منو '];
  menu_closed = true;
  constructor() { }

  ngOnInit(): void {
  }
  close_menu(){
    this.menu_closed = !this.menu_closed
    
  }
}
