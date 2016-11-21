<?php 
    //session_start();
    ob_start();
    //include 'funciones.php';
    //extract($_GET);
    $imsmanifest_organization="";

$adlcp_rootv1p2 = '<?xml version="1.0"?>
<!-- filename=adlcp_rootv1p2.xsd -->
<!-- Conforms to w3c http://www.w3.org/TR/xmlschema-1/ 2000-10-24-->

<xsd:schema xmlns="http://www.adlnet.org/xsd/adlcp_rootv1p2"
            targetNamespace="http://www.adlnet.org/xsd/adlcp_rootv1p2"
            xmlns:xml="http://www.w3.org/XML/1998/namespace"
            xmlns:imscp="http://www.imsproject.org/xsd/imscp_rootv1p1p2"
            xmlns:xsd="http://www.w3.org/2001/XMLSchema"
            elementFormDefault="unqualified"
            version="ADL Version 1.2">

        <xsd:import namespace="http://www.imsproject.org/xsd/imscp_rootv1p1p2" schemaLocation="imscp_rootv1p1p2.xsd"/>

        <xsd:element name="location" type="locationType"/>
        <xsd:element name="prerequisites" type="prerequisitesType"/>
        <xsd:element name="maxtimeallowed" type="maxtimeallowedType"/>
        <xsd:element name="timelimitaction" type="timelimitactionType"/>
        <xsd:element name="datafromlms" type="datafromlmsType"/>
        <xsd:element name="masteryscore" type="masteryscoreType"/>


        <xsd:element name="schema" type="newSchemaType"/>
        <xsd:simpleType name="newSchemaType">
                <xsd:restriction base="imscp:schemaType">
                        <xsd:enumeration value="ADL SCORM"/>
                </xsd:restriction>
        </xsd:simpleType>

        <xsd:element name="schemaversion" type="newSchemaversionType"/>
        <xsd:simpleType name="newSchemaversionType">
                <xsd:restriction base="imscp:schemaversionType">
                        <xsd:enumeration value="1.2"/>
                </xsd:restriction>
        </xsd:simpleType>


        <xsd:attribute name="scormtype">
            <xsd:simpleType>
                <xsd:restriction base="xsd:string">
                   <xsd:enumeration value="asset"/>
                   <xsd:enumeration value="sco"/>
                </xsd:restriction>
            </xsd:simpleType>
        </xsd:attribute>

        <xsd:simpleType name="locationType">
                <xsd:restriction base="xsd:string">
                        <xsd:maxLength value="2000"/>
                </xsd:restriction>
        </xsd:simpleType>


        <xsd:complexType name="prerequisitesType">
           <xsd:simpleContent>
              <xsd:extension base="prerequisiteStringType">
                  <xsd:attributeGroup ref="attr.prerequisitetype"/>
              </xsd:extension>
           </xsd:simpleContent>
        </xsd:complexType>

        <xsd:attributeGroup name="attr.prerequisitetype">
                <xsd:attribute name="type" use="required">
                        <xsd:simpleType>
                                <xsd:restriction base="xsd:string">
                                   <xsd:enumeration value="aicc_script"/>
                                </xsd:restriction>
                        </xsd:simpleType>
                </xsd:attribute>
        </xsd:attributeGroup>

        <xsd:simpleType name="maxtimeallowedType">
                <xsd:restriction base="xsd:string">
                        <xsd:maxLength value="13"/>
                </xsd:restriction>
        </xsd:simpleType>

        <xsd:simpleType name="timelimitactionType">
                <xsd:restriction base="stringType">
                        <xsd:enumeration value="exit,no message"/>
                        <xsd:enumeration value="exit,message"/>
                        <xsd:enumeration value="continue,no message"/>
                        <xsd:enumeration value="continue,message"/>
                </xsd:restriction>
        </xsd:simpleType>

        <xsd:simpleType name="datafromlmsType">
                <xsd:restriction base="xsd:string">
                        <xsd:maxLength value="255"/>
                </xsd:restriction>
        </xsd:simpleType>

        <xsd:simpleType name="masteryscoreType">
                <xsd:restriction base="xsd:string">
                        <xsd:maxLength value="200"/>
                </xsd:restriction>
        </xsd:simpleType>

        <xsd:simpleType name="stringType">
                <xsd:restriction base="xsd:string"/>
        </xsd:simpleType>
        
        <xsd:simpleType name="prerequisiteStringType">
                <xsd:restriction base="xsd:string">
                   <xsd:maxLength value="200"/>
                </xsd:restriction>
        </xsd:simpleType>

</xsd:schema>';

$ims_xml = '<?xml version="1.0" encoding="UTF-8"?>
<!-- filename=ims_xml.xsd -->
<xsd:schema targetNamespace="http://www.w3.org/XML/1998/namespace" xmlns="http://www.w3.org/XML/1998/namespace" xmlns:xsd="http://www.w3.org/2001/XMLSchema" elementFormDefault="unqualified">
	<!-- 2001-02-22 edited by Thomas Wason IMS Global Learning Consortium, Inc. -->
	<xsd:annotation>
		<xsd:documentation>In namespace-aware XML processors, the &quot;xml&quot; prefix is bound to the namespace name http://www.w3.org/XML/1998/namespace.</xsd:documentation>
		<xsd:documentation>Do not reference this file in XML instances</xsd:documentation>
	</xsd:annotation>
	<xsd:attribute name="lang" type="xsd:language">
		<xsd:annotation>
			<xsd:documentation>Refers to universal  XML 1.0 lang attribute</xsd:documentation>
		</xsd:annotation>
	</xsd:attribute>
	<xsd:attribute name="base" type="xsd:anyURI">
		<xsd:annotation>
			<xsd:documentation>Refers to XML Base: http://www.w3.org/TR/xmlbase</xsd:documentation>
		</xsd:annotation>
	</xsd:attribute>
	<xsd:attribute name="link" type="xsd:anyURI"/>
</xsd:schema>';

$imscp_rootv1p1p2 = '<?xml version="1.0"?>

<!-- edited with XML Spy v3.5 (http://www.xmlspy.com) by Thomas Wason (private) -->
<!-- filename=ims_cp_rootv1p1p2.xsd -->
<!-- Copyright (2) 2001 IMS Global Learning Consortium, Inc. -->
<!-- edited by Thomas Wason  -->
<!-- Conforms to w3c http://www.w3.org/TR/xmlschema-1/ 2000-10-24-->

<xsd:schema xmlns="http://www.imsproject.org/xsd/imscp_rootv1p1p2" 
            targetNamespace="http://www.imsproject.org/xsd/imscp_rootv1p1p2" 
            xmlns:xml="http://www.w3.org/XML/1998/namespace" 
            xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
            elementFormDefault="unqualified" version="IMS CP 1.1.2">

   <!-- ******************** -->
   <!-- ** Change History ** -->
   <!-- ******************** -->
   <xsd:annotation>
      <xsd:documentation xml:lang="en">DRAFT XSD for IMS Content Packaging version 1.1 DRAFT</xsd:documentation>
      <xsd:documentation> Copyright (c) 2001 IMS GLC, Inc. </xsd:documentation>
      <xsd:documentation>2000-04-21, Adjustments by T.D. Wason from CP 1.0.</xsd:documentation>
      <xsd:documentation>2001-02-22, T.D.Wason: Modify for 2000-10-24 XML-Schema version.  Modified to support extension.</xsd:documentation>
      <xsd:documentation>2001-03-12, T.D.Wason: Change filename, target and meta-data namespaces and meta-data fielname.  Add meta-data to itemType, fileType and organizationType.</xsd:documentation>
      <xsd:documentation>Do not define namespaces for xml in XML instances generated from this xsd.</xsd:documentation>
      <xsd:documentation>Imports IMS meta-data xsd, lower case element names.         </xsd:documentation>
      <xsd:documentation>This XSD provides a reference to the IMS meta-data root element as imsmd:record</xsd:documentation>
      <xsd:documentation>If the IMS meta-data is to be used in the XML instance then the instance must define an IMS meta-data prefix with a namespace.  The meta-data targetNamespace should be used.  </xsd:documentation>
      <xsd:documentation>2001-03-20, Thor Anderson: Remove manifestref, change resourceref back to identifierref, change manifest back to contained by manifest. --Tom Wason: manifest may contain _none_ or more manifests.</xsd:documentation>
      <xsd:documentation>2001-04-13 Tom Wason: corrected attirbute name structure.  Was misnamed type.  </xsd:documentation>
      <xsd:documentation>2001-05-14 Schawn Thropp: Made all complexType extensible with the group.any</xsd:documentation>
      <xsd:documentation>Added the anyAttribute to all complexTypes. Changed the href attribute on the fileType and resourceType to xsd:string</xsd:documentation>
      <xsd:documentation>Changed the maxLength of the href, identifierref, parameters, structure attributes to match the Information model.</xsd:documentation>
      <xsd:documentation>2001-07-25 Schawn Thropp: Changed the namespace for the Schema of Schemas to the 5/2/2001 W3C XML Schema</xsd:documentation> 
      <xsd:documentation>Recommendation. attributeGroup attr.imsmd deleted, was not used anywhere.  Any attribute declarations that have</xsd:documentation>
      <xsd:documentation>use = "default" changed to use="optional" - attr.structure.req.</xsd:documentation>
      <xsd:documentation>Any attribute declarations that have value="somevalue" changed to default="somevalue",</xsd:documentation>
      <xsd:documentation>attr.structure.req (hierarchical).  Removed references to IMS MD Version 1.1.</xsd:documentation>
      <xsd:documentation>Modified attribute group "attr.resourcetype.req" to change use from optional</xsd:documentation>
      <xsd:documentation>to required to match the information model.  As a result the default value also needed to be removed</xsd:documentation> 
      <xsd:documentation>Name change for XSD.  Changed to match version of CP Spec                                           </xsd:documentation> 
   </xsd:annotation>

   <xsd:annotation>
      <xsd:documentation>Inclusions and Imports</xsd:documentation>
   </xsd:annotation>

   <xsd:import namespace="http://www.w3.org/XML/1998/namespace" schemaLocation="ims_xml.xsd"/>

   <xsd:annotation>
      <xsd:documentation>Attribute Declarations</xsd:documentation>
   </xsd:annotation>

   <!-- **************************** -->
   <!-- ** Attribute Declarations ** -->
   <!-- **************************** -->
   <xsd:attributeGroup name="attr.base">
      <xsd:attribute ref="xml:base" use="optional"/>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.default">
      <xsd:attribute name="default" type="xsd:IDREF" use="optional"/>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.href">
      <xsd:attribute name="href" use="optional">
         <xsd:simpleType>
            <xsd:restriction base="xsd:anyURI">
               <xsd:maxLength value="2000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.href.req">
      <xsd:attribute name="href" use="required">
         <xsd:simpleType>
            <xsd:restriction base="xsd:anyURI">
               <xsd:maxLength value="2000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup> 

   <xsd:attributeGroup name="attr.identifier.req">
      <xsd:attribute name="identifier" type="xsd:ID" use="required"/>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.identifier">
      <xsd:attribute name="identifier" type="xsd:ID" use="optional"/>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.isvisible">
      <xsd:attribute name="isvisible" type="xsd:boolean" use="optional"/>
   </xsd:attributeGroup>
   
   <xsd:attributeGroup name="attr.parameters">
      <xsd:attribute name="parameters" use="optional">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="1000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>
   
   <xsd:attributeGroup name="attr.identifierref">
      <xsd:attribute name="identifierref" use="optional">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="2000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>
   
   <xsd:attributeGroup name="attr.identifierref.req">
      <xsd:attribute name="identifierref" use="required">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="2000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>
                
   <xsd:attributeGroup name="attr.resourcetype.req">
      <xsd:attribute name="type" use="required">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="1000"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.structure.req">
      <xsd:attribute name="structure" use="optional" default="hierarchical">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="200"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>

   <xsd:attributeGroup name="attr.version">
      <xsd:attribute name="version" use="optional">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:maxLength value="20"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>

   <xsd:annotation>
       <xsd:documentation>element groups</xsd:documentation>
   </xsd:annotation>

   <xsd:group name="grp.any">
      <xsd:annotation>
         <xsd:documentation>Any namespaced element from any namespace may be included within an &quot;any&quot; element.  The namespace for the imported element must be defined in the instance, and the schema must be imported.  </xsd:documentation>
      </xsd:annotation>
      <xsd:sequence>
         <xsd:any namespace="##other" processContents="strict" minOccurs="0" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:group>

   <!-- ************************** -->
   <!-- ** Element Declarations ** -->
   <!-- ************************** -->

   <xsd:element name="dependency" type="dependencyType"/>
   <xsd:element name="file" type="fileType"/>
   <xsd:element name="item" type="itemType"/>
   <xsd:element name="manifest" type="manifestType"/>
   <xsd:element name="metadata" type="metadataType"/>
   <xsd:element name="organization" type="organizationType"/>
   <xsd:element name="organizations" type="organizationsType"/>
   <xsd:element name="resource" type="resourceType"/>
   <xsd:element name="resources" type="resourcesType"/>
   <xsd:element name="schema" type="schemaType"/>
   <xsd:element name="schemaversion" type="schemaversionType"/>
   <xsd:element name="title" type="titleType"/>

   <!-- ******************* -->
   <!-- ** Complex Types ** -->
   <!-- ******************* -->

   <!-- **************** -->
   <!-- ** dependency ** -->
   <!-- **************** -->
   <xsd:complexType name="dependencyType">
      <xsd:sequence>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.identifierref.req"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ********** -->
   <!-- ** file ** -->
   <!-- ********** -->
   <xsd:complexType name="fileType">
      <xsd:sequence>
         <xsd:element ref="metadata" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.href.req"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ********** -->
   <!-- ** item ** -->
   <!-- ********** -->
   <xsd:complexType name="itemType">
      <xsd:sequence>
         <xsd:element ref="title" minOccurs="0"/>
         <xsd:element ref="item" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="metadata" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.identifier.req"/>
      <xsd:attributeGroup ref="attr.identifierref"/>
      <xsd:attributeGroup ref="attr.isvisible"/>
      <xsd:attributeGroup ref="attr.parameters"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ************** -->
   <!-- ** manifest ** -->
   <!-- ************** -->
   <xsd:complexType name="manifestType">
      <xsd:sequence>
         <xsd:element ref="metadata" minOccurs="0"/>
         <xsd:element ref="organizations"/>
         <xsd:element ref="resources"/>
         <xsd:element ref="manifest" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.identifier.req"/>
      <xsd:attributeGroup ref="attr.version"/>
      <xsd:attribute ref="xml:base"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ************** -->
   <!-- ** metadata ** -->
   <!-- ************** -->
   <xsd:complexType name="metadataType">
      <xsd:sequence>
         <xsd:element ref="schema" minOccurs="0"/>
         <xsd:element ref="schemaversion" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <!-- ******************* -->
   <!-- ** organizations ** -->
   <!-- ******************* -->
   <xsd:complexType name="organizationsType">
      <xsd:sequence>
         <xsd:element ref="organization" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.default"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ****************** -->
   <!-- ** organization ** -->
   <!-- ****************** -->
   <xsd:complexType name="organizationType">
      <xsd:sequence>
         <xsd:element ref="title" minOccurs="0"/>
         <xsd:element ref="item" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="metadata" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.identifier.req"/>
      <xsd:attributeGroup ref="attr.structure.req"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- *************** -->
   <!-- ** resources ** -->
   <!-- *************** -->
   <xsd:complexType name="resourcesType">
      <xsd:sequence>
          <xsd:element ref="resource" minOccurs="0" maxOccurs="unbounded"/>
          <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.base"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>
   
   <!-- ************** -->
   <!-- ** resource ** -->
   <!-- ************** -->
   <xsd:complexType name="resourceType">
      <xsd:sequence>
         <xsd:element ref="metadata" minOccurs="0"/>
         <xsd:element ref="file" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="dependency" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
      <xsd:attributeGroup ref="attr.identifier.req"/>
      <xsd:attributeGroup ref="attr.resourcetype.req"/>
      <xsd:attributeGroup ref="attr.base"/>
      <xsd:attributeGroup ref="attr.href"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
   </xsd:complexType>

   <!-- ****************** -->
   <!-- ** Simple Types ** -->
   <!-- ****************** -->

   <!-- ************ -->
   <!-- ** schema ** -->
   <!-- ************ -->
   <xsd:simpleType name="schemaType">
      <xsd:restriction base="xsd:string">
         <xsd:maxLength value="100"/>
      </xsd:restriction>
   </xsd:simpleType>
   
   <!-- ******************* -->
   <!-- ** schemaversion ** -->
   <!-- ******************* -->
   <xsd:simpleType name="schemaversionType">
      <xsd:restriction base="xsd:string">
         <xsd:maxLength value="20"/>
      </xsd:restriction>
   </xsd:simpleType>
   
   <!-- *********** -->
   <!-- ** title ** -->
   <!-- *********** -->
   <xsd:simpleType name="titleType">
      <xsd:restriction base="xsd:string">
         <xsd:maxLength value="200"/>
      </xsd:restriction>
   </xsd:simpleType>

</xsd:schema>';

$imsmd_rootv1p2p1 = '<?xml version="1.0" encoding="UTF-8"?>
<!-- edited by Thomas Wason  -->
<xsd:schema targetNamespace="http://www.imsglobal.org/xsd/imsmd_rootv1p2p1" 
            xmlns:xml="http://www.w3.org/XML/1998/namespace" 
            xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
            xmlns="http://www.imsglobal.org/xsd/imsmd_rootv1p2p1" 
            elementFormDefault="qualified" 
            version="1.2:1.1 IMS:MD1.2">

   <xsd:import namespace="http://www.w3.org/XML/1998/namespace" schemaLocation="ims_xml.xsd"/> 

   <!-- ******************** -->
   <!-- ** Change History ** -->
   <!-- ******************** -->
   <xsd:annotation>
      <xsd:documentation>2001-04-26 T.D.Wason. IMS meta-data 1.2 XML-Schema.                                  </xsd:documentation>
      <xsd:documentation>2001-06-07 S.E.Thropp. Changed the multiplicity on all elements to match the         </xsd:documentation>
      <xsd:documentation>Final 1.2 Binding Specification.                                                     </xsd:documentation>
      <xsd:documentation>Changed all elements that use the langstringType to a multiplicy of 1 or more        </xsd:documentation>
      <xsd:documentation>Changed centity in the contribute element to have a multiplicity of 0 or more.       </xsd:documentation>
      <xsd:documentation>Changed the requirement element to have a multiplicity of 0 or more.                 </xsd:documentation>
      <xsd:documentation> 2001-07-25 Schawn Thropp.  Updates to bring the XSD up to speed with the W3C        </xsd:documentation>
      <xsd:documentation> XML Schema Recommendation.  The following changes were made: Change the             </xsd:documentation>
      <xsd:documentation> namespace to reference the 5/2/2001 W3C XML Schema Recommendation,the base          </xsd:documentation>
      <xsd:documentation> type for the durtimeType, simpleType, was changed from timeDuration to duration.    </xsd:documentation>              
      <xsd:documentation> Any attribute declarations that have use="default" had to change to use="optional"  </xsd:documentation>
      <xsd:documentation> - attr.type.  Any attribute declarations that have value ="somevalue" had to change </xsd:documentation>
      <xsd:documentation> to default = "somevalue" - attr.type (URI)                                          </xsd:documentation>
      <xsd:documentation> 2001-09-04 Schawn Thropp                                                            </xsd:documentation>
      <xsd:documentation> Changed the targetNamespace and namespace of schema to reflect version change       </xsd:documentation>
   </xsd:annotation>

   <!-- *************************** -->
   <!-- ** Attribute Declaration ** -->
   <!-- *************************** -->

   <xsd:attributeGroup name="attr.type">
      <xsd:attribute name="type" use="optional" default="URI">
         <xsd:simpleType>
            <xsd:restriction base="xsd:string">
               <xsd:enumeration value="URI"/>
               <xsd:enumeration value="TEXT"/>
            </xsd:restriction>
         </xsd:simpleType>
      </xsd:attribute>
   </xsd:attributeGroup>

   <xsd:group name="grp.any">
      <xsd:annotation>
         <xsd:documentation>Any namespaced element from any namespace may be used for an &quot;any&quot; element.  The namespace for the imported element must be defined in the instance, and the schema must be imported.  </xsd:documentation>
      </xsd:annotation>
      <xsd:sequence>
         <xsd:any namespace="##any" processContents="strict" minOccurs="0" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:group>

   <!-- ************************* -->
   <!-- ** Element Declaration ** -->
   <!-- ************************* -->

   <xsd:element name="aggregationlevel" type="aggregationlevelType"/>
   <xsd:element name="annotation" type="annotationType"/>
   <xsd:element name="catalogentry" type="catalogentryType"/>
   <xsd:element name="catalog" type="catalogType"/>
   <xsd:element name="centity" type="centityType"/>
   <xsd:element name="classification" type="classificationType"/>
   <xsd:element name="context" type="contextType"/>
   <xsd:element name="contribute" type="contributeType"/>
   <xsd:element name="copyrightandotherrestrictions" type="copyrightandotherrestrictionsType"/>
   <xsd:element name="cost" type="costType"/>
   <xsd:element name="coverage" type="coverageType"/>
   <xsd:element name="date" type="dateType"/>
   <xsd:element name="datetime" type="datetimeType"/>
   <xsd:element name="description" type="descriptionType"/>
   <xsd:element name="difficulty" type="difficultyType"/>
   <xsd:element name="educational" type="educationalType"/>
   <xsd:element name="entry" type="entryType"/>
   <xsd:element name="format" type="formatType"/>
   <xsd:element name="general" type="generalType"/>
   <xsd:element name="identifier" type="xsd:string"/>
   <xsd:element name="intendedenduserrole" type="intendedenduserroleType"/>
   <xsd:element name="interactivitylevel" type="interactivitylevelType"/>
   <xsd:element name="interactivitytype" type="interactivitytypeType"/>
   <xsd:element name="keyword" type="keywordType"/>
   <xsd:element name="kind" type="kindType"/>
   <xsd:element name="langstring" type="langstringType"/>
   <xsd:element name="language" type="xsd:string"/>
   <xsd:element name="learningresourcetype" type="learningresourcetypeType"/>
   <xsd:element name="lifecycle" type="lifecycleType"/>
   <xsd:element name="location" type="locationType"/>
   <xsd:element name="lom" type="lomType"/>
   <xsd:element name="maximumversion" type="minimumversionType"/>
   <xsd:element name="metadatascheme" type="metadataschemeType"/>
   <xsd:element name="metametadata" type="metametadataType"/>
   <xsd:element name="minimumversion" type="maximumversionType"/>
   <xsd:element name="name" type="nameType"/>
   <xsd:element name="purpose" type="purposeType"/>
   <xsd:element name="relation" type="relationType"/>
   <xsd:element name="requirement" type="requirementType"/>
   <xsd:element name="resource" type="resourceType"/>
   <xsd:element name="rights" type="rightsType"/>
   <xsd:element name="role" type="roleType"/>
   <xsd:element name="semanticdensity" type="semanticdensityType"/>
   <xsd:element name="size" type="sizeType"/>
   <xsd:element name="source" type="sourceType"/>
   <xsd:element name="status" type="statusType"/>
   <xsd:element name="structure" type="structureType"/>
   <xsd:element name="taxon" type="taxonType"/>
   <xsd:element name="taxonpath" type="taxonpathType"/>
   <xsd:element name="technical" type="technicalType"/>
   <xsd:element name="title" type="titleType"/>
   <xsd:element name="type" type="typeType"/>
   <xsd:element name="typicalagerange" type="typicalagerangeType"/>
   <xsd:element name="typicallearningtime" type="typicallearningtimeType"/>
   <xsd:element name="value" type="valueType"/>
   <xsd:element name="person" type="personType"/>
   <xsd:element name="vcard" type="xsd:string"/>
   <xsd:element name="version" type="versionType"/>
   <xsd:element name="installationremarks" type="installationremarksType"/>
   <xsd:element name="otherplatformrequirements" type="otherplatformrequirementsType"/>
   <xsd:element name="duration" type="durationType"/>
   <xsd:element name="id" type="idType"/>

   <!-- ******************* -->
   <!-- ** Complex Types ** -->
   <!-- ******************* -->

   <xsd:complexType name="aggregationlevelType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="annotationType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="person" minOccurs="0"/>
         <xsd:element ref="date" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="catalogentryType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="catalog"/>
         <xsd:element ref="entry"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="centityType">
      <xsd:sequence>
         <xsd:element ref="vcard"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="classificationType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="purpose" minOccurs="0"/>
         <xsd:element ref="taxonpath" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="description" minOccurs="0"/>
         <xsd:element ref="keyword" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="contextType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="contributeType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="role"/>
         <xsd:element ref="centity" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="date" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="copyrightandotherrestrictionsType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="costType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="coverageType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="dateType">
      <xsd:sequence>
         <xsd:element ref="datetime" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="descriptionType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="difficultyType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="durationType">
      <xsd:sequence>
         <xsd:element ref="datetime" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="educationalType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="interactivitytype" minOccurs="0"/>
         <xsd:element ref="learningresourcetype" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="interactivitylevel" minOccurs="0"/>
         <xsd:element ref="semanticdensity" minOccurs="0"/>
         <xsd:element ref="intendedenduserrole" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="context" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="typicalagerange" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="difficulty" minOccurs="0"/>
         <xsd:element ref="typicallearningtime" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
         <xsd:element ref="language" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="entryType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="generalType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="identifier" minOccurs="0"/>
         <xsd:element ref="title" minOccurs="0"/>
         <xsd:element ref="catalogentry" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="language" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="description" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="keyword" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="coverage" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="structure" minOccurs="0"/>
         <xsd:element ref="aggregationlevel" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="installationremarksType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="intendedenduserroleType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="interactivitylevelType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="interactivitytypeType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="keywordType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="kindType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="langstringType">
      <xsd:simpleContent>
         <xsd:extension base="xsd:string">
            <xsd:attribute ref="xml:lang"/>
         </xsd:extension>
      </xsd:simpleContent>
   </xsd:complexType>
   
   <xsd:complexType name="learningresourcetypeType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="lifecycleType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="version" minOccurs="0"/>
         <xsd:element ref="status" minOccurs="0"/>
         <xsd:element ref="contribute" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="locationType">
      <xsd:simpleContent>
         <xsd:extension base="xsd:string">
            <xsd:attributeGroup ref="attr.type"/>
         </xsd:extension>
      </xsd:simpleContent>
   </xsd:complexType>
   
   <xsd:complexType name="lomType">
      <xsd:sequence>
         <xsd:element ref="general" minOccurs="0"/>
         <xsd:element ref="lifecycle" minOccurs="0"/>
         <xsd:element ref="metametadata" minOccurs="0"/>
         <xsd:element ref="technical" minOccurs="0"/>
         <xsd:element ref="educational" minOccurs="0"/>
         <xsd:element ref="rights" minOccurs="0"/>
         <xsd:element ref="relation" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="annotation" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="classification" minOccurs="0" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="metametadataType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="identifier" minOccurs="0"/>
         <xsd:element ref="catalogentry" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="contribute" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="metadatascheme" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="language" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="nameType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="otherplatformrequirementsType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="personType">
      <xsd:sequence>
         <xsd:element ref="vcard"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="purposeType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="relationType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="kind" minOccurs="0"/>
         <xsd:element ref="resource" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="requirementType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="type" minOccurs="0"/>
         <xsd:element ref="name" minOccurs="0"/>
         <xsd:element ref="minimumversion" minOccurs="0"/>
         <xsd:element ref="maximumversion" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="resourceType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="identifier" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
         <xsd:element ref="catalogentry" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="rightsType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="cost" minOccurs="0"/>
         <xsd:element ref="copyrightandotherrestrictions" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="roleType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="semanticdensityType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="sourceType">
      <xsd:sequence>
         <xsd:element ref="langstring"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="statusType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="stringType">
      <xsd:simpleContent>
         <xsd:extension base="xsd:string">
            <xsd:attribute ref="xml:lang"/>
         </xsd:extension>
      </xsd:simpleContent>
   </xsd:complexType>
   
   <xsd:complexType name="structureType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="taxonpathType">
      <xsd:sequence>
         <xsd:element ref="source" minOccurs="0"/>
         <xsd:element ref="taxon" minOccurs="0" maxOccurs="1"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="taxonType">
      <xsd:sequence>
         <xsd:element ref="id" minOccurs="0"/>
         <xsd:element ref="entry" minOccurs="0"/>
         <xsd:element ref="taxon" minOccurs="0" maxOccurs="1"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="technicalType" mixed="true">
      <xsd:sequence>
         <xsd:element ref="format" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="size" minOccurs="0"/>
         <xsd:element ref="location" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="requirement" minOccurs="0" maxOccurs="unbounded"/>
         <xsd:element ref="installationremarks" minOccurs="0"/>
         <xsd:element ref="otherplatformrequirements" minOccurs="0"/>
         <xsd:element ref="duration" minOccurs="0"/>
         <xsd:group ref="grp.any"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="titleType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="typeType">
      <xsd:sequence>
         <xsd:element ref="source"/>
         <xsd:element ref="value"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="typicalagerangeType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="typicallearningtimeType">
      <xsd:sequence>
         <xsd:element ref="datetime" minOccurs="0"/>
         <xsd:element ref="description" minOccurs="0"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="valueType">
      <xsd:sequence>
         <xsd:element ref="langstring"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <xsd:complexType name="versionType">
      <xsd:sequence>
         <xsd:element ref="langstring" minOccurs="1" maxOccurs="unbounded"/>
      </xsd:sequence>
   </xsd:complexType>
   
   <!-- ****************** -->
   <!-- ** Simple Types ** -->
   <!-- ****************** -->
   
   <xsd:simpleType name="formatType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="sizeType">
      <xsd:restriction base="xsd:int"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="datetimeType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="idType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="metadataschemeType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="catalogType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="minimumversionType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>
   
   <xsd:simpleType name="maximumversionType">
      <xsd:restriction base="xsd:string"/>
   </xsd:simpleType>

</xsd:schema>';

$imsmanifest_cabecera = '<?xml version="1.0" encoding="UTF-8"?>
<!--This is a Reload version 2.5.5 SCORM 1.2 Content Package document-->
<!--Spawned from the Reload Content Package Generator - http://www.reload.ac.uk-->
<manifest xmlns="http://www.imsproject.org/xsd/imscp_rootv1p1p2" xmlns:imsmd="http://www.imsglobal.org/xsd/imsmd_rootv1p2p1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:adlcp="http://www.adlnet.org/xsd/adlcp_rootv1p2" identifier="MANIFEST-'.codigos_aleatorios_2().'" xsi:schemaLocation="http://www.imsproject.org/xsd/imscp_rootv1p1p2 imscp_rootv1p1p2.xsd http://www.imsglobal.org/xsd/imsmd_rootv1p2p1 imsmd_rootv1p2p1.xsd http://www.adlnet.org/xsd/adlcp_rootv1p2 adlcp_rootv1p2.xsd">
  <metadata>
    <schema>ADL SCORM</schema>
    <schemaversion>1.2</schemaversion>
  </metadata>'.chr(13).'';




function codigos_aleatorios_2() {
    $an = "0123456789ABCDEF";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}
?>