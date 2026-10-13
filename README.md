# Kopion & La Capital del Café - Web App

---

## 🇪🇸 Descripción del Proyecto y Contexto del Negocio

### Problemática de Negocio
Las sucursales de papelería **"Kopion"** (ubicadas en planteles del IPN como CECyT 1, ESCA Santo Tomás y ESE) junto con la cafetería **"La Capital del Café"** enfrentaban retos operativos complejos debido a la falta de un sistema digital unificado:

1. **Falta de Control de Inventario y Fuga de Insumos:** Inexistencia de un catálogo estandarizado entre papelería y cafetería. Además, no se distinguía entre productos para venta directa (cuadernos, café, USBs) e insumos de uso interno (Fabuloso, diurex, franelas), lo que dificultaba la conciliación de stock.
2. **Saturación y Desorden en Impresiones (WhatsApp):** El envío de archivos para impresión mediante aplicaciones informales como WhatsApp provocaba pérdidas de documentos, cuellos de botella en horarios pico y falta de privacidad para los alumnos.
3. **Gestión Descentralizada e Ineficiente:** La gerencia/dirección no contaba con un mecanismo en tiempo real para autorizar compras, verificar la asistencia del personal en cada plantel ni auditar vales de caja o adelantos de sueldo.

### Solución Implementada
Esta plataforma web (desarrollada en **Laravel** con base de datos **MySQL**) actúa como el núcleo del sistema operativo dual:
* **Inventario Inteligente:** Registro separado de insumos internos vs. productos de venta con trazabilidad de movimientos de stock.
* **Módulo Smart-Print:** Cola de impresión ordenada que vincula directamente los pedidos de los clientes con el detalle de la orden.
* **Aprobación en Un Clic ("One-Click Approval"):** Interfaz para que empleados soliciten entradas de mercancía o vales de pago y la dirección general los valide remotamente.
* **Control Operativo:** Checador digital de asistencia (*attendances*) y asignación de roles/tareas de mantenimiento por sucursal.

---

## 🇬🇧 Project Description & Business Context

### Business Problem Statement
The stationery branches of **"Kopion"** (located near IPN campuses: CECyT 1, ESCA Santo Tomás, ESE) and the cafeteria **"La Capital del Café"** faced severe operational challenges due to the absence of a unified management system:

1. **Inventory Discrepancies & Internal Supply Tracking:** Lack of a standardized catalog across stationery and cafeteria operations. Moreover, there was no distinction between retail products (notebooks, coffee, tech accessories) and internal store supplies (cleaning products, tape, cloths), hindering stock accuracy.
2. **Print Queue Bottlenecks via WhatsApp:** Receiving printing jobs informally through WhatsApp led to lost files, privacy risks, and long waiting lines during rush hours.
3. **Lack of Remote Auditing & Control:** Management lacked a real-time system to approve inventory restocks, verify employee clock-ins across branches, or audit petty cash and supplier payment vouchers.

### Implemented Solution
This web application (built with **Laravel** and **MySQL**) serves as the core backend of the dual-stack operational environment:
* **Smart Inventory Management:** Clear distinction between internal supplies and retail products, backed by audit-trail history.
* **Smart-Print Engine:** Structured print queue tied directly to order details and customer requests.
* **One-Click Managerial Approval:** Decentralized workflow allowing store staff to request restocks or vouchers, validated remotely by management.
* **Store Operations Hub:** Digital employee attendance clock-in/out system and scheduled store maintenance tasks.

---

## 📐 Entity-Relationship Diagram / Diagrama Entidad-Relación

<img width="8192" height="4855" alt="ER diagram" src="https://github.com/user-attachments/assets/2983a7ca-50c9-46f1-8b37-ceaced75f5f1" />
