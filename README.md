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

--- 

---

## 🇪🇸 Funcionalidad del Backend (API REST)

Se desarrolló una API RESTful para la gestión centralizada de **Usuarios** y **Órdenes**, implementando operaciones CRUD completas. El backend cuenta con validación estricta de datos, mapeo de roles y borrado lógico (Soft Deletes) para preservar el historial de transacciones sin destruir registros físicos en la base de datos.

### Endpoints Disponibles

| Método | Endpoint | Propósito |
|---|---|---|
| **POST** | `/api/users` | Registra un nuevo usuario en el sistema validando su rol y tipo de cliente. |
| **POST** | `/api/orders` | Crea una nueva orden vinculada a un usuario, empleado y sucursal. |
| **GET** | `/api/orders/{id}` | Recupera los detalles específicos de una orden activa. |
| **PUT** | `/api/orders/{id}` | Actualiza la información de una orden (ej. cambiar el estado a "Completado"). |
| **DELETE** | `/api/orders/{id}` | Ejecuta un borrado lógico (Soft Delete) archivando la orden por seguridad. |
| **GET** | `/api/orders/archived` | Devuelve la lista de todas las órdenes que han sido archivadas (borrado lógico). |

---

## 🇬🇧 Backend Functionality (REST API)

A RESTful API was developed for the centralized management of **Users** and **Orders**, implementing full CRUD operations. The backend features strict data validation, role mapping, and logical deletion (Soft Deletes) to preserve transaction history without permanently destroying database rows.

### Available API Endpoints

| Method | Endpoint | Purpose |
|---|---|---|
| **POST** | `/api/users` | Registers a new user in the system, validating role and customer type. |
| **POST** | `/api/orders` | Creates a new order linked to a specific user, employee, and branch. |
| **GET** | `/api/orders/{id}` | Retrieves the specific details of an active order. |
| **PUT** | `/api/orders/{id}` | Updates an existing order's information (e.g., changing status to "Completed"). |
| **DELETE** | `/api/orders/{id}` | Executes a soft delete, archiving the order for data integrity and security. |
| **GET** | `/api/orders/archived` | Fetches a list of all soft-deleted (archived) orders. |

