
import { SystemService } from './../../services/api/system.service';

import { Component, ElementRef, OnInit, Renderer2, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import {TooltipPosition} from '@angular/material/tooltip';
@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  current_route = '';
  tt_disabled = false;
  positionOptions: TooltipPosition[] = ['below', 'above', 'left', 'right'];
  currentComponent = "0";
  height = '50px';
  menu_items:any ;
  overflow = 'hidden';
  time:any;
  menu_item = ['منو','منو','منو','منو','منو '];
  menu_closed = true;
  constructor(private eleRef: ElementRef, private sysService: SystemService,private route: ActivatedRoute,
    private renderer: Renderer2, private router: Router) {
      
      
    this.sysService.getMenuItems().subscribe(res=>{
      this.menu_items = res.body
      console.log(this.menu_items)
      this.currentComponent = this.router.url.substring(this.router.url.lastIndexOf('/') + 1);
      this.current_active_menu(this.currentComponent)
    })
   }

  ngOnInit(): void {
   
  }
  
  close_menu(){
    this.tt_disabled = !this.tt_disabled
    this.overflow= 'hidden';
    this.menu_closed = !this.menu_closed
    if(!this.menu_closed){
      let time = setTimeout(() => {
        this.overflow= 'visible';
      }, 500);
    }
  } 
  menu_click(target:any,item:any){
    
    if(item.sub_items != ""){
      let classes = target.getAttribute("class");
      if(classes.indexOf('menu_item_stuff') > -1){// clicked on menu_stuff
        if(classes.indexOf('down') > -1){
          this.renderer.removeClass(target,'down')
        }else{
          this.renderer.addClass(target,'down')
        }
      }else{                                     // clicked on insides of menu_stuff
        target = this.renderer.parentNode(target)
        classes = target.getAttribute("class");
        if(classes.indexOf('down') > -1){
          this.renderer.removeClass(target,'down')
        }else{
          this.renderer.addClass(target,'down')
        }
      }
      let parent = this.renderer.parentNode(target);
      classes = parent.getAttribute("class");
        if(classes.indexOf('opened') > -1){
          this.renderer.removeClass(parent,'opened')
          this.renderer.setStyle(parent,'height','50px')
        }else{
          let opened = this.eleRef.nativeElement.querySelector('.opened');
          if(opened != null ){
              this.renderer.removeClass(opened,'opened')
              this.renderer.setStyle(opened,'height','50px')
          }
          this.renderer.addClass(parent,'opened')
          let height = ((item.sub_items.length*50) +50 ) + 'px'
          this.renderer.setStyle(parent,'height',height)
        }
    }else{
      console.log(item)
      if(item.page_link == 'create-flowchart'){
        this.current_active_menu("create-flowchart")
        this.router.navigate(['dashboard/create-flowchart'])
      }
    }
  }
  current_active_menu(path:string){
    console.log('path')
    this.current_route = path
  }
}
